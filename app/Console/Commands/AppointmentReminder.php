<?php

namespace App\Console\Commands;

use App\Repositories\AppointmentRepository;
use Illuminate\Console\Command;
use Twilio\Exceptions\ConfigurationException;

class AppointmentReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointment:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Appointment Reminder SMS and Email';
    /**
     * @var AppointmentRepository
     */
    private $appointmentRepository;

    /**
     * Create a new command instance.
     *
     * @param  AppointmentRepository  $appointmentRepository
     */
    public function __construct(AppointmentRepository $appointmentRepository)
    {
        parent::__construct();
        $this->appointmentRepository = $appointmentRepository;
    }

    /**
     * Execute the console command.
     *
     * @throws ConfigurationException
     * @return mixed
     */
    public function handle()
    {
        $this->info('Sending Appointment Reminders...');

        $this->appointmentRepository->sendAppointmentReminder();
        $this->info('The SMS and emails are send successfully!');

        return true;
    }
}
