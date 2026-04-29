<?php
use Illuminate\Support\Str;
use App\Models\Boarder;

$boarders = Boarder::whereNull('qrcode_value')->get();
foreach ($boarders as $b) {
    $b->update(['qrcode_value' => Str::uuid()->toString()]);
}
echo 'Updated ' . $boarders->count() . ' boarders.';
