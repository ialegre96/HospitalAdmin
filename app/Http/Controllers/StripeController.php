<?php

namespace App\Http\Controllers;

use App\Models\IpdPatientDepartment;
use App\Repositories\StripeRepository;
use Auth;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use View;

/**
 * Class StripeController
 */
class StripeController extends AppBaseController
{
    /**
     * @var StripeRepository
     */
    private $stripeRepository;

    public function __construct(StripeRepository $stripeRepository)
    {
        $this->stripeRepository = $stripeRepository;
    }

    /**
     * @param  Request  $request
     *
     * @throws ApiErrorException
     *
     * @return JsonResponse
     */
    public function createSession(Request $request)
    {
        $amount = $request->get('amount');
        $ipdNumber = $request->get('ipdNumber');
        $ipdPaientId = IpdPatientDepartment::whereIpdNumber($ipdNumber)->first()->id;

        $user = $request->user();
        $userEmail = $user->email;

        setStripeApiKey();
        $session = Session::create([
            'payment_method_types' => ['card'],
            'customer_email'       => $userEmail,
            'line_items'           => [
                [
                    'price_data'  => [
                        'product_data' => [
                            'name' => 'BILL OF PATIENT with IPD #'.$ipdNumber,
                        ],
                        'unit_amount'  => $amount * 100,
                        'currency'     => 'USD',
                    ],
                    'quantity'    => 1,
                    'description' => 'BILL OF PATIENT with IPD #'.$ipdNumber,
                ],
            ],
            'client_reference_id'  => $ipdPaientId,
            'mode'                 => 'payment',
            'success_url'          => url('stripe-payment-success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'           => url('failed-payment?error=payment_cancelled'),
        ]);
        $result = [
            'sessionId' => $session['id'],
        ];

        return $this->sendResponse($result, 'Session created successfully.');
    }

    /**
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return RedirectResponse|RedirectorStripe::setApiKey(<API-KEY>)
     */
    public function paymentSuccess(Request $request)
    {
        $sessionId = $request->get('session_id');

        if (empty($sessionId)) {
            throw new UnprocessableEntityHttpException('session_id required');
        }

        $this->stripeRepository->patientPaymentSuccess($sessionId);

        Flash::success('Your Payment is successfully completed');

        return redirect(route('patient.ipd'));

    }

    /**
     * @return Factory|View
     */
    public function handleFailedPayment()
    {
        return view('ipd_patient_list.ipd_listing_tables.failed_payments');
    }
}
