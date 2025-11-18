<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('newsletter_campaigns', function (Blueprint $t) {
            $t->id();
            $t->string('subject');
            $t->text('html');              // store rendered HTML
            $t->text('text')->nullable();  // optional plain text
            $t->timestamp('sent_at')->nullable();
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newsletter_campaigns');
    }
};
