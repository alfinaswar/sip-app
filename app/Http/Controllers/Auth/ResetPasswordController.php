<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected function validationErrorMessages()
    {
        return [
            'token.required' => 'Token reset kata sandi tidak valid.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'password.required' => 'Kata sandi baru wajib diisi.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'password.min' => 'Kata sandi minimal harus :min karakter.',
        ];
    }

    protected function sendResetResponse(Request $request, $response)
    {
        $message = $this->translateResetResult($response);

        if ($request->wantsJson()) {
            return new JsonResponse(['message' => $message], 200);
        }

        return redirect($this->redirectPath())->with('status', $message);
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        $message = $this->translateResetResult($response);

        if ($request->wantsJson()) {
            throw ValidationException::withMessages([
                'email' => [$message],
            ]);
        }

        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => $message]);
    }

    private function translateResetResult(string $response): string
    {
        return match ($response) {
            Password::PASSWORD_RESET => 'Kata sandi Anda berhasil diatur ulang.',
            Password::INVALID_TOKEN => 'Token reset kata sandi tidak valid atau sudah kedaluwarsa. Silakan ajukan tautan baru.',
            Password::INVALID_USER => 'Kami tidak dapat menemukan akun pengguna dengan alamat email tersebut.',
            default => trans($response),
        };
    }
}
