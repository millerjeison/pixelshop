<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\WhatsappRequest;
use Smartisan\Settings\Facades\Settings;

class WhatsappService
{
    public $envService;

    public function __construct()
    {}

    /**
     * @throws Exception
     */
    public function list()
    {
        try {
            return Settings::group('whatsapp')->all();
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            throw new Exception($exception->getMessage(), 422);
        }
    }

    /**
     * @throws Exception
     */
    public function update(WhatsappRequest $request)
    {
        try {
            Settings::group('whatsapp')->set($request->validated());
            return $this->list();
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            throw new Exception($exception->getMessage(), 422);
        }
    }
}
