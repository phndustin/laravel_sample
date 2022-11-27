<?php

namespace App\Services\Impls;

use App\Services\Google2faService;
use Google2FA;
use Storage;
use App\Models\User;
use App\Repositories\Google2faQrcodeRepository;
use App\Exceptions\BusinessException;

class Google2faServiceImpl extends GenericServiceImpl implements Google2faService {
    private $google2faQrcodeRepository;

    public function __construct(
        Google2faQrcodeRepository $google2faQrcodeRepository
    ) {
        $this->google2faQrcodeRepository = $google2faQrcodeRepository;
    }

    public function generateQRCode(User $user) {
        $qrcodeName = config('app.name') . $user->username;

        $secret = Google2FA::generateSecretKey();
        $content = $inlineUrl = Google2FA::getQRCodeInline(
            $qrcodeName,
            $user->username,
            $secret,
        );
        $filename = sprintf('qrcodes/%s.svg', $qrcodeName);
        Storage::disk('s3')->put($filename, $content);

        $url = url(Storage::url($filename));
        return [
            'secret' => $secret,
            'url' => $url,
        ];
    }

    public function verifyOTP(User $user, $otp) {
        if (empty($otp)) {
            throw new BusinessException('otp.invalid');
        }

        $qrcode = $this->google2faQrcodeRepository->findOneByUserId($user->id);
        if (!$qrcode) {
            throw new BusinessException('qrcode.not_found');
        }

        $isvalid = Google2FA::verifyKey($qrcode->secret, $otp);
        if (!$isvalid) {
            throw new BusinessException('otp.invalid');
        }
    }
}
