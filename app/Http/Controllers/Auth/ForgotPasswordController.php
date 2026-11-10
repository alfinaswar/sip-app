<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        try {
            $response = $this->broker()->sendResetLink(
                $this->credentials($request)
            );
        } catch (TransportExceptionInterface $e) {
            report($e);

            $table = config('auth.passwords.' . config('auth.defaults.passwords') . '.table', 'password_reset_tokens');
            DB::table($table)->where('email', $request->input('email'))->delete();

            $message = 'Gagal mengirim email reset kata sandi. Layanan email (SMTP) sedang tidak aktif atau tidak dapat dihubungi.';

            if ($request->wantsJson()) {
                return new JsonResponse(['message' => $message], 503);
            }

            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => $message]);
        }

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }

    protected function validateEmail(Request $request)
    {
        $request->validate(
            ['email' => 'required|email'],
            [
                'email.required' => 'Alamat email wajib diisi.',
                'email.email' => 'Format alamat email tidak valid.',
            ]
        );
    }

    protected function sendResetLinkResponse(Request $request, $response)
    {
        $message = $this->translateResetStatus($response);

        return $request->wantsJson()
            ? new JsonResponse(['message' => $message], 200)
            : back()->with('status', $message);
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        $message = $this->translateResetStatus($response);

        if ($request->wantsJson()) {
            throw ValidationException::withMessages([
                'email' => [$message],
            ]);
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => $message]);
    }

    private function translateResetStatus(string $response): string
    {
        return match ($response) {
            Password::RESET_LINK_SENT => 'Tautan reset kata sandi telah dikirim ke email Anda. Silakan periksa kotak masuk atau folder spam.',
            Password::INVALID_USER => 'Kami tidak dapat menemukan akun pengguna dengan alamat email tersebut.',
            Password::RESET_THROTTLED => 'Terlalu banyak permintaan. Mohon tunggu beberapa saat sebelum mencoba lagi.',
            default => trans($response),
        };
    }
}
