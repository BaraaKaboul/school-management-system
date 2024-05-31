<?php

namespace App\Providers;

use App\Repository\AttendanceRepositoryInterface;
use App\Repository\ExamRepositoryInterface;
use App\Repository\FeesInvoicesRepositoryInterface;
use App\Repository\FeesRepositoryInterface;
use App\Repository\LibraryRepositoryInterface;
use App\Repository\PaymentRepositoryInterface;
use App\Repository\ProcessingFeesRepositoryInterface;
use App\Repository\QuestionsRepositoryInterface;
use App\Repository\QuizzRepositoryInterface;
use App\Repository\ReceiptStudentRepositoryInterface;
use App\Repository\StudentGraduateRepositoryInterface;
use App\Repository\SubjectRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            'App\Repository\TeacherRepositoryInterface', // Interface
            'App\Repository\TeacherRepository' // Implementation
        );

        $this->app->bind(
            'App\Repository\StudentRepositoryInterface', // Interface
            'App\Repository\StudentRepository' // Implementation
        );

        $this->app->bind(
            'App\Repository\StudentPromotionRepositoryInterface', // Interface
            'App\Repository\StudentPromotionRepository' // Implementation
        );

        $this->app->bind(
            'App\Repository\StudentGraduateRepositoryInterface', // Interface
            'App\Repository\StudentGraduateRepository' // Implementation
        );

        $this->app->bind(
            'App\Repository\FeesRepositoryInterface', // Interface
            'App\Repository\FeesRepository' // Implementation
        );

        $this->app->bind(
            'App\Repository\FeesInvoicesRepositoryInterface', // Interface
            'App\Repository\FeesInvoicesRepository' // Implementation
        );

        $this->app->bind(
            'App\Repository\ReceiptStudentRepositoryInterface', // Interface
            'App\Repository\ReceiptStudentRepository' // Implementation
        );

        $this->app->bind(
            'App\Repository\ProcessingFeesRepositoryInterface', // Interface
            'App\Repository\ProcessingFeesRepository' // Implementation
        );

        $this->app->bind(
            'App\Repository\PaymentRepositoryInterface', // Interface
            'App\Repository\PaymentRepository' // Implementation
        );

        $this->app->bind(
            'App\Repository\AttendanceRepositoryInterface', // Interface
            'App\Repository\AttendanceRepository' // Implementation
        );

        $this->app->bind(
            'App\Repository\SubjectRepositoryInterface', // Interface
            'App\Repository\SubjectRepository' // Implementation
        );

        $this->app->bind(
            'App\Repository\QuizzRepositoryInterface', // Interface
            'App\Repository\QuizzRepository' // Implementation
        );

        $this->app->bind(
            'App\Repository\QuestionsRepositoryInterface', // Interface
            'App\Repository\QuestionsRepository' // Implementation
        );

        $this->app->bind(
            'App\Repository\LibraryRepositoryInterface', // Interface
            'App\Repository\LibraryRepository' // Implementation
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
