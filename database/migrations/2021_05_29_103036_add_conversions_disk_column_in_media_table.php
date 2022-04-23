<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConversionsDiskColumnInMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media', function (Blueprint $table) {
            $table->string('conversions_disk')->nullable();
            $table->uuid('uuid')->nullable()->unique();
            $table->text('generated_conversions');

            if (Schema::hasColumn('media', 'manipulations')) {
                Schema::table('media', function (Blueprint $table) {
                    $table->text('manipulations')->change();
                });
            } else {
                Schema::table('media', function (Blueprint $table) {
                    $table->text('manipulations')->change();
                });
            }

            if (Schema::hasColumn('media', 'custom_properties')) {
                Schema::table('media', function (Blueprint $table) {
                    $table->text('custom_properties')->change();
                });
            } else {
                Schema::table('media', function (Blueprint $table) {
                    $table->text('custom_properties')->change();
                });
            }

            if (Schema::hasColumn('media', 'responsive_images')) {
                Schema::table('media', function (Blueprint $table) {
                    $table->text('responsive_images')->change();
                });
            } else {
                Schema::table('media', function (Blueprint $table) {
                    $table->text('responsive_images')->change();
                });
            }
        });
        DB::table('media')->update([
            'conversions_disk' => DB::raw('disk'),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('media', function (Blueprint $table) {
            $table->dropColumn('conversions_disk');
        });
    }
}
