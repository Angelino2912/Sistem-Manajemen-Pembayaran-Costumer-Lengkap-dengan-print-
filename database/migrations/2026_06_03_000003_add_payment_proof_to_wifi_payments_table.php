<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wifi_payments', function (Blueprint $table) {
            $table->string('payment_proof')->nullable()->after('paid_at');
            $table->timestamp('submitted_at')->nullable()->after('payment_proof');
        });
    }

    public function down(): void
    {
        Schema::table('wifi_payments', function (Blueprint $table) {
            $table->dropColumn(['payment_proof', 'submitted_at']);
        });
    }
};
