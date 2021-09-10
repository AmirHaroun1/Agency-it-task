<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformanceReviewsRevieweesReviewersPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_reviews_reviewees_reviewers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('performance_id');
            $table->foreign('performance_id')
                ->references('id')
                ->on('performance_reviews')
                ->onDelete('cascade');

            $table->foreignId('reviewee_id')->nullable();
            $table->foreign('reviewee_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreignId('reviewer_id')->nullable();
            $table->foreign('reviewer_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->text('feedback')->nullable();
            $table->boolean('status')->default(0); // 0 for Pending - 1 for Submitted
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('performance_reviews_reviewees_reviewers');
    }
}
