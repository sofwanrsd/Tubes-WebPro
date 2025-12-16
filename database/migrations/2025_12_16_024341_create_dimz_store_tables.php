<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('publisher_id')->constrained('users')->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->unsignedInteger('price')->default(0);

            // cover public
            $table->string('cover_path')->nullable();

            // file private
            $table->string('file_path')->nullable();

            $table->enum('status', ['draft', 'published', 'unpublished'])->default('draft');

            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            $table->enum('status', ['pending', 'paid', 'expired', 'failed', 'cancelled'])->default('pending');

            $table->unsignedInteger('subtotal')->default(0);
            $table->unsignedInteger('unique_code')->default(0);
            $table->unsignedInteger('total_amount')->default(0);

            $table->timestamp('expires_at')->nullable();
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('book_id')->constrained('books')->cascadeOnDelete();
            $table->unsignedInteger('price')->default(0);
            $table->timestamps();

            $table->unique(['order_id', 'book_id']);
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete()->unique();

            $table->string('method')->default('QRIS_DYNAMIC_FROM_STATIC');
            $table->unsignedInteger('expected_amount')->default(0);

            $table->string('qris_static_ref')->nullable();

            $table->longText('qris_dynamic_payload')->nullable();
            $table->longText('qris_dynamic_image')->nullable(); // data URL base64 (qr_png)

            $table->timestamp('qris_generated_at')->nullable();
            $table->timestamp('last_checked_at')->nullable();

            $table->enum('status', ['pending', 'paid', 'expired'])->default('pending');

            $table->timestamps();
        });

        Schema::create('used_mutations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();

            // Anti double-claim (UNIQUE)
            $table->string('mutation_key')->unique();
            $table->unsignedBigInteger('mutation_id')->nullable();

            $table->unsignedInteger('amount')->default(0);
            $table->timestamp('mutation_time')->nullable();
            $table->text('description')->nullable();
            $table->json('raw')->nullable();

            $table->timestamps();
        });

        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('actor_id')->nullable()->constrained('users')->nullOnDelete();

            $table->string('action');
            $table->string('target_type');
            $table->unsignedBigInteger('target_id')->nullable();
            $table->json('meta')->nullable();

            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('used_mutations');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('books');
    }
};
