<?php

namespace App\Console\Commands;

use App\Repositories\AppointmentRepository;
use Illuminate\Console\Command;

class SendAppointmentReminderEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:appointment-reminder-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to patient and doctor before one hour of an appointment.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Sending Appointment Reminder Emails...');

        /** @var AppointmentRepository $appointmentRepo */
        $appointmentRepo = app(AppointmentRepository::class);
        $appointmentRepo->sendAppointmentEmailBeforeOneHour();

        $this->info('Appointment Reminder Emails Sent Successfully!');

        return true;
    }
}
