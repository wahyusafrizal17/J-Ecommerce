@component('mail::message')
# Terima kasih, {{ $order->name }} 🎉

Kami sangat menghargai kepercayaan Anda telah berbelanja di **Sonbill Store**.
Pesanan anda akan segara kami kirimkan

---

## 🧾 Detail Pesanan Anda:

**Invoice:** {{ $order->invoice_no }}  
**Status Pesanan:** {{ $order->status }}  
**Total Pembayaran:** Rp {{ number_format($order->amount, 0, ',', '.') }}

---

@component('mail::button', ['url' => route('dashboard')])
Lihat Riwayat Pesanan
@endcomponent 

Jika Anda memiliki pertanyaan atau butuh bantuan, silakan hubungi kami kapan saja.

Terima kasih telah berbelanja bersama kami!  
Salam hangat,  
**Tim Sonbill Store**

@endcomponent
