<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('position')->nullable()->after('password');
            $table->string('school')->nullable()->after('position');
            $table->string('subject_group')->nullable()->after('school');
            $table->string('academic_standing')->nullable()->after('subject_group');
            $table->string('phone')->nullable()->after('academic_standing');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'position',
                'school',
                'subject_group',
                'academic_standing',
                'phone',
            ]);
        });
    }
};
