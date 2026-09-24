<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Efarmer receipt {{ $payment->payment_reference }}</title>
</head>
<body style="margin:0;padding:0;background-color:#f2faf3;font-family:Helvetica,Arial,sans-serif;color:#1a4629;">

    {{-- Preheader (hidden preview text) --}}
    <div style="display:none;max-height:0;overflow:hidden;opacity:0;color:transparent;">
        Payment successful — your official receipt for {{ $payment->payment_reference }} is inside.
    </div>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f2faf3;padding:24px 12px;">
        <tr>
            <td align="center">

                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="width:100%;max-width:600px;background-color:#ffffff;border-radius:16px;overflow:hidden;border:1px solid #e0f4e4;">

                    {{-- HEADER --}}
                    <tr>
                        <td style="background-color:#1a4629;text-align:center;padding:36px 24px;">
                            <table role="presentation" cellpadding="0" cellspacing="0" align="center">
                                <tr>
                                    <td style="background-color:#d27c37;border-radius:50%;width:56px;height:56px;text-align:center;vertical-align:middle;">
                                        <span style="font-size:26px;line-height:56px;color:#ffffff;">&#10003;</span>
                                    </td>
                                </tr>
                            </table>
                            <h1 style="margin:18px 0 0;font-size:24px;line-height:30px;color:#ffffff;font-weight:bold;">
                                Payment successful
                            </h1>
                            <p style="margin:8px 0 0;font-size:14px;line-height:20px;color:rgba(255,255,255,0.65);">
                                Your digital receipt is ready below.
                            </p>
                        </td>
                    </tr>

                    {{-- RECEIPT BODY --}}
                    <tr>
                        <td style="padding:32px 28px;">

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" style="padding-bottom:6px;">
                                        <img src="{{ $message->embed(public_path('images/logo.png')) }}" alt="Efarmer" width="120" style="display:block;border:0;height:auto;max-width:180px;">
                                        <p style="margin:12px 0 0;font-size:11px;letter-spacing:2px;text-transform:uppercase;color:#9ca3af;font-weight:bold;">
                                            Official receipt
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            {{-- KEY DETAILS --}}
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-top:24px;border-top:2px dashed #c2e9ca;border-bottom:2px dashed #c2e9ca;">
                                <tr>
                                    <td style="padding:14px 0;font-size:14px;color:#9ca3af;">Receipt no</td>
                                    <td align="right" style="padding:14px 0;font-size:14px;color:#1a4629;font-weight:bold;font-family:'Courier New',monospace;">{{ $payment->payment_reference }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 0;font-size:14px;color:#9ca3af;border-top:1px solid #e0f4e4;">Date</td>
                                    <td align="right" style="padding:14px 0;font-size:14px;color:#1a4629;font-weight:bold;border-top:1px solid #e0f4e4;">{{ ($payment->payment_date ?? $payment->updated_at)->format('d M Y, H:i') }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 0;font-size:14px;color:#9ca3af;border-top:1px solid #e0f4e4;">M-Pesa receipt</td>
                                    <td align="right" style="padding:14px 0;font-size:14px;color:#1a4629;font-weight:bold;font-family:'Courier New',monospace;border-top:1px solid #e0f4e4;">{{ $payment->transaction_id ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 0;font-size:14px;color:#9ca3af;border-top:1px solid #e0f4e4;">Method</td>
                                    <td align="right" style="padding:14px 0;font-size:14px;color:#1a4629;font-weight:bold;border-top:1px solid #e0f4e4;">M-Pesa</td>
                                </tr>
                            </table>

                            {{-- BUYER & DELIVERY --}}
                            <h2 style="margin:28px 0 0;font-size:16px;color:#1a4629;font-weight:bold;">Buyer &amp; delivery</h2>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-top:12px;">
                                @if(preg_match('/Buyer:\s*([^|]+)/', $payment->notes ?? '', $buyerMatch))
                                <tr>
                                    <td style="padding:6px 0;font-size:14px;color:#9ca3af;">Buyer</td>
                                    <td align="right" style="padding:6px 0;font-size:14px;color:#1a4629;font-weight:bold;">{{ trim($buyerMatch[1]) }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td style="padding:6px 0;font-size:14px;color:#9ca3af;">Phone</td>
                                    <td align="right" style="padding:6px 0;font-size:14px;color:#1a4629;font-weight:bold;">{{ $payment->phone_number }}</td>
                                </tr>
                                @if(preg_match('/Delivery:\s*([^|]+)/', $payment->notes ?? '', $deliveryMatch))
                                <tr>
                                    <td style="padding:6px 0;font-size:14px;color:#9ca3af;">Deliver to</td>
                                    <td align="right" style="padding:6px 0;font-size:14px;color:#1a4629;font-weight:bold;">{{ trim($deliveryMatch[1]) }}</td>
                                </tr>
                                @endif
                                @if(preg_match('/Goat:\s*([^|]+)/', $payment->notes ?? '', $goatMatch))
                                <tr>
                                    <td style="padding:6px 0;font-size:14px;color:#9ca3af;">Goat</td>
                                    <td align="right" style="padding:6px 0;font-size:14px;color:#1a4629;font-weight:bold;">{{ trim($goatMatch[1]) }}</td>
                                </tr>
                                @endif
                            </table>

                            {{-- AMOUNT BREAKDOWN --}}
                            @php
                                $quantity = 1;
                                if (preg_match('/Qty:\s*(\d+)/', $payment->notes ?? '', $qtyMatch)) {
                                    $quantity = max(1, (int) $qtyMatch[1]);
                                }
                                $transportFee = (int) config('mpesa.transport_fee_per_goat', 300) * $quantity;
                                $subtotal = max(0, (float) $payment->amount - $transportFee);
                            @endphp

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-top:24px;background-color:#f2faf3;border:1px solid #e0f4e4;border-radius:12px;">
                                <tr>
                                    <td style="padding:20px;">
                                        <p style="margin:0;font-size:15px;color:#1a4629;font-weight:bold;">Amount</p>

                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-top:10px;">
                                            <tr>
                                                <td style="padding:4px 0;font-size:14px;color:#6b7280;">Goat price{{ $quantity > 1 ? " (×{$quantity})" : '' }}</td>
                                                <td align="right" style="padding:4px 0;font-size:14px;color:#1a4629;font-weight:bold;">KSh {{ number_format($subtotal) }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:4px 0;font-size:14px;color:#6b7280;">Transport fee</td>
                                                <td align="right" style="padding:4px 0;font-size:14px;color:#1a4629;font-weight:bold;">KSh {{ number_format($transportFee) }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:12px 0 0;font-size:15px;color:#1a4629;font-weight:bold;border-top:1px solid #e0f4e4;">Total paid</td>
                                                <td align="right" style="padding:12px 0 0;font-size:20px;color:#1f5631;font-weight:bold;border-top:1px solid #e0f4e4;">KSh {{ number_format((float) $payment->amount) }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            {{-- FOOTER --}}
                            <p style="margin:24px 0 0;font-size:14px;line-height:21px;color:#6b7280;text-align:center;">
                                Asante for your purchase. Our delivery team will call you shortly.
                            </p>

                            <table role="presentation" cellpadding="0" cellspacing="0" align="center" style="margin-top:20px;">
                                <tr>
                                    <td style="background-color:#2c8748;border-radius:10px;">
                                        <a href="{{ route('payment.receipt', ['reference' => $payment->payment_reference]) }}"
                                           style="display:inline-block;padding:12px 26px;font-size:14px;font-weight:bold;color:#ffffff;text-decoration:none;">
                                            View receipt online
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:22px 0 0;font-size:12px;line-height:18px;color:#9ca3af;text-align:center;">
                                Support: +254 712 345 678 &middot; support@efarmer.co.ke
                            </p>

                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>

