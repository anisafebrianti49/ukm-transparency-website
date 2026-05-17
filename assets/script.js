// ===== Toggle Password (untuk login) =====
function togglePassword() {
    const passwordInput = document.getElementById('password');
    if(passwordInput.type === 'password') {
        passwordInput.type = 'text';
    } else {
        passwordInput.type = 'password';
    }
}

// ===== Konfirmasi Logout =====
function confirmLogout() {
    return confirm('Apakah Anda yakin ingin logout?');
}

// ===== Auto-hide alert =====
document.addEventListener('DOMContentLoaded', function(){
    const alert = document.querySelector('.alert');
    if(alert){
        setTimeout(() => {
            alert.style.display = 'none';
        }, 3000); // hilang setelah 3 detik
    }
});

// ===== Table row highlight on hover =====
document.querySelectorAll('table tbody tr').forEach(row => {
    row.addEventListener('mouseover', () => row.style.backgroundColor = 'rgba(77,163,255,0.2)');
    row.addEventListener('mouseout', () => row.style.backgroundColor = '');
});

function tampilMetode(){
    var metode = document.getElementById("metode").value;
    document.getElementById("infoTransfer").style.display = (metode === "transfer") ? "block" : "none";
    document.getElementById("infoQRIS").style.display = (metode === "qris") ? "block" : "none";
}

function copyRek() {
    var copyText = document.getElementById("norek");
    copyText.select();
    copyText.setSelectionRange(0, 99999);

    navigator.clipboard.writeText(copyText.value);

    alert("Nomor rekening berhasil disalin!");
}

var jumlah = document.getElementById('jumlah');

jumlah.addEventListener('keyup', function(e){
    this.value = formatRupiah(this.value, 'Rp ');
});

function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   	 = number_string.split(','),
    sisa     	 = split[0].length % 3,
    rupiah     	 = split[0].substr(0, sisa),
    ribuan     	 = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    return prefix + rupiah;
}

function copyRek(){
    var copyText = document.getElementById("norek");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
    alert("Nomor rekening berhasil disalin!");
}