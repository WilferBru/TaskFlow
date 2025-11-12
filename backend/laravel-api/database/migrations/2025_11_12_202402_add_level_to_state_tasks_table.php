<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // agegamos un nuevo cmapo a la tabal ya que se encesita apra los colores visiaules en vue o el frontend
        Schema::table('state_tasks', function (Blueprint $table) {
            $table->tinyInteger('level')->default(1)->after('state')->comment('1=Bajo,2=Medio,3=Alto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('state_tasks', function (Blueprint $table) {
            $table->dropColumn('level');
        });
    }
};
