<?php

use App\Http\Controllers\Clinical\AttendanceIndexController;
use App\Http\Controllers\Clinical\AttendanceShowController;
use App\Http\Controllers\Clinical\AttendanceStoreController;
use App\Http\Controllers\Clinical\EvolutionDestroyController;
use App\Http\Controllers\Clinical\EvolutionIndexController;
use App\Http\Controllers\Clinical\EvolutionShowController;
use App\Http\Controllers\Clinical\EvolutionStoreController;
use App\Http\Controllers\Clinical\EvolutionUpdateController;
use App\Http\Controllers\Clinical\MedicalRecordDestroyController;
use App\Http\Controllers\Clinical\MedicalRecordIndexController;
use App\Http\Controllers\Clinical\MedicalRecordShowController;
use App\Http\Controllers\Clinical\MedicalRecordStoreController;
use App\Http\Controllers\Clinical\PatientDestroyController;
use App\Http\Controllers\Clinical\PatientIndexController;
use App\Http\Controllers\Clinical\PatientShowController;
use App\Http\Controllers\Clinical\PatientStoreController;
use App\Http\Controllers\Clinical\PatientUpdateController;
use App\Http\Controllers\Clinical\PsychologistDestroyController;
use App\Http\Controllers\Clinical\PsychologistIndexController;
use App\Http\Controllers\Clinical\PsychologistShowController;
use App\Http\Controllers\Clinical\PsychologistStoreController;
use App\Http\Controllers\Clinical\PsychologistUpdateController;
use App\Http\Controllers\Clinical\SpecialtyDestroyController;
use App\Http\Controllers\Clinical\SpecialtyIndexController;
use App\Http\Controllers\Clinical\SpecialtyShowController;
use App\Http\Controllers\Clinical\SpecialtyStoreController;
use App\Http\Controllers\Clinical\SpecialtyUpdateController;
use App\Http\Controllers\Clinical\StaffDestroyController;
use App\Http\Controllers\Clinical\StaffIndexController;
use App\Http\Controllers\Clinical\StaffShowController;
use App\Http\Controllers\Clinical\StaffStoreController;
use App\Http\Controllers\Clinical\StaffUpdateController;
use App\Http\Controllers\Identity\AuthForgotPasswordController;
use App\Http\Controllers\Identity\AuthLoginController;
use App\Http\Controllers\Identity\AuthLogoutController;
use App\Http\Controllers\Identity\AuthMeController;
use App\Http\Controllers\Identity\AuthResetPasswordController;
use App\Http\Controllers\Scheduling\AppointmentIndexController;
use App\Http\Controllers\Scheduling\AppointmentShowController;
use App\Http\Controllers\Scheduling\AppointmentStoreController;
use App\Http\Controllers\Scheduling\AppointmentUpdateController;
use App\Http\Controllers\Scheduling\AvailabilityDestroyController;
use App\Http\Controllers\Scheduling\AvailabilityIndexController;
use App\Http\Controllers\Scheduling\AvailabilityShowController;
use App\Http\Controllers\Scheduling\AvailabilityStoreController;
use App\Http\Controllers\Scheduling\AvailabilityUpdateController;
use App\Http\Controllers\Scheduling\ScheduleBlockDestroyController;
use App\Http\Controllers\Scheduling\ScheduleBlockIndexController;
use App\Http\Controllers\Scheduling\ScheduleBlockShowController;
use App\Http\Controllers\Scheduling\ScheduleBlockStoreController;
use App\Http\Controllers\Scheduling\ScheduleBlockUpdateController;
use App\Http\Controllers\Tenancy\TenantShowController;
use Illuminate\Support\Facades\Route;

Route::post('/login', AuthLoginController::class);
Route::post('/forgot-password', AuthForgotPasswordController::class);
Route::post('/reset-password', AuthResetPasswordController::class);

Route::middleware('auth:sanctum')->group(function (): void {
    Route::get('/me', AuthMeController::class);
    Route::post('/logout', AuthLogoutController::class);

    Route::get('/specialties', SpecialtyIndexController::class);
    Route::post('/specialties', SpecialtyStoreController::class);
    Route::get('/specialties/{specialty}', SpecialtyShowController::class);
    Route::put('/specialties/{specialty}', SpecialtyUpdateController::class);
    Route::delete('/specialties/{specialty}', SpecialtyDestroyController::class);

    Route::middleware('tenant')->group(function (): void {
        Route::get('/tenant', TenantShowController::class);

        Route::get('/patients', PatientIndexController::class);
        Route::post('/patients', PatientStoreController::class);
        Route::get('/patients/{patient}', PatientShowController::class);
        Route::put('/patients/{patient}', PatientUpdateController::class);
        Route::delete('/patients/{patient}', PatientDestroyController::class);

        Route::get('/psychologists', PsychologistIndexController::class);
        Route::post('/psychologists', PsychologistStoreController::class);
        Route::get('/psychologists/{psychologist}', PsychologistShowController::class);
        Route::put('/psychologists/{psychologist}', PsychologistUpdateController::class);
        Route::delete('/psychologists/{psychologist}', PsychologistDestroyController::class);

        Route::get('/staff', StaffIndexController::class);
        Route::post('/staff', StaffStoreController::class);
        Route::get('/staff/{staff}', StaffShowController::class);
        Route::put('/staff/{staff}', StaffUpdateController::class);
        Route::delete('/staff/{staff}', StaffDestroyController::class);

        Route::get('/availabilities', AvailabilityIndexController::class);
        Route::post('/availabilities', AvailabilityStoreController::class);
        Route::get('/availabilities/{availability}', AvailabilityShowController::class);
        Route::put('/availabilities/{availability}', AvailabilityUpdateController::class);
        Route::delete('/availabilities/{availability}', AvailabilityDestroyController::class);

        Route::get('/schedule-blocks', ScheduleBlockIndexController::class);
        Route::post('/schedule-blocks', ScheduleBlockStoreController::class);
        Route::get('/schedule-blocks/{scheduleBlock}', ScheduleBlockShowController::class);
        Route::put('/schedule-blocks/{scheduleBlock}', ScheduleBlockUpdateController::class);
        Route::delete('/schedule-blocks/{scheduleBlock}', ScheduleBlockDestroyController::class);

        Route::get('/appointments', AppointmentIndexController::class);
        Route::post('/appointments', AppointmentStoreController::class);
        Route::get('/appointments/{appointment}', AppointmentShowController::class);
        Route::put('/appointments/{appointment}', AppointmentUpdateController::class);

        Route::get('/medical-records', MedicalRecordIndexController::class);
        Route::post('/medical-records', MedicalRecordStoreController::class);
        Route::get('/medical-records/{medicalRecord}', MedicalRecordShowController::class);
        Route::delete('/medical-records/{medicalRecord}', MedicalRecordDestroyController::class);

        Route::get('/attendances', AttendanceIndexController::class);
        Route::post('/attendances', AttendanceStoreController::class);
        Route::get('/attendances/{attendance}', AttendanceShowController::class);

        Route::get('/evolutions', EvolutionIndexController::class);
        Route::post('/evolutions', EvolutionStoreController::class);
        Route::get('/evolutions/{evolution}', EvolutionShowController::class);
        Route::put('/evolutions/{evolution}', EvolutionUpdateController::class);
        Route::delete('/evolutions/{evolution}', EvolutionDestroyController::class);
    });
});
