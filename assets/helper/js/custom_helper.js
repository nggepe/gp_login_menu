function sqlToDateTimeIndo(tgl)
{
    tgl = tgl.split(" ")
    date = tgl[0].split("-");
    return date[2]+"/"+date[1]+"/"+date[0]+" "+tgl[1];
}

function sqlToDateIndo(tgl)
{
    tgl = tgl.split("-");
    return tgl[2]+"/"+tgl[1]+"/"+tgl[0];
}

function formatRupiah(a){
    //a = Math.round(a);
    if (a !== null) {
        a= a.toString();       
        var b = a.replace(/[^\d\,]/g,'');
        var dump = b.split(',');
        var c = '';
        var lengthchar = dump[0].length;
        var j = 0;
        for (var i = lengthchar; i > 0; i--) {
                j = j + 1;
                if (((j % 3) == 1) && (j != 1)) {
                        c = dump[0].substr(i-1,1) + '.' + c;
                } else {
                        c = dump[0].substr(i-1,1) + c;
                }
        }
        
        if(dump.length>1){
                if(dump[1].length>0){
                        c += ','+dump[1];
                }else{
                        c += ',';
                }
        }
        return c;
    } else {
        return '0';
    }
}

function toCurrency(el) {
    return el.value = formatRupiah(el.value);
}

function formatToNumber(currency){
    var value = 0; var result = 0;
    if (currency !== null && currency !== undefined) {
        value=currency.replace(/\.+/g, '');
        result= value.replace(/,/g, '.');
    }
    return parseFloat(result);
}

function formatTanggal(tanggal) {
    if (tanggal !== undefined && tanggal !== null && tanggal !== 'null') {
        var elem = tanggal.split('-');
        var tahun = elem[0];
        var bulan = elem[1];
        var hari  = elem[2];
        return hari+'/'+bulan+'/'+tahun;
    } else {
        return '';
    }
}

function round2Dig(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}

function formatRupiahWC(num) { // rupiah with comas
    if (num >= 0) {
        if(num.toString().indexOf('.') !== -1) {
            var coma = roundToTwo(num).toString().split('.');
            var new_coma = numtocurr(coma[0]);
            var new_coma2= '';
            if (coma[1] !== undefined && coma[1].length === 1) {
                new_coma2= coma[1]+'0';
            }
            else if (coma[1] === undefined) {
                new_coma2= '00';
            }
            else {
                new_coma2= coma[1];
            }
            if (new_coma2 === '00') {
                return new_coma;
            }else{
                var new_num  = new_coma+','+new_coma2;
                return new_num;    
            }
            
        } else {
            return numtocurr(num);
        }
    } 
    if (num < 0) {
        if(Math.abs(num).toString().indexOf('.') !== -1) {
            var coma = roundToTwo(num).toString().split('.');
            var new_coma = numtocurr(coma[0]);
            var new_coma2= '';
            
            if (((coma[1] !== undefined)?coma[1]:'0').length === 1) {
                new_coma2= ((coma[1] !== undefined)?coma[1]:'0')+'0';
            } else {
                new_coma2= coma[1];
            }
            var new_num  = new_coma+','+new_coma2;
            return '-'+new_num;
        } else {
            return '-'+numtocurr(num);
        }
    }
}

function roundToTwo(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}

 function precise_round(num, decimals) {
    var t=Math.pow(10, decimals);   
    return (Math.round((num * t) + (decimals>0?1:0)*(Math.sign(num) * (10 / Math.pow(100, decimals)))) / t).toFixed(decimals);
}

function numtocurr(a){
    if (a !== null) {
        a=a.toString();       
        var b = a.replace(/[^\d\,]/g,'');
        var dump = b.split(',');
        var c = '';
        var lengthchar = dump[0].length;
        var j = 0;
        for (var i = lengthchar; i > 0; i--) {
                j = j + 1;
                if (((j % 3) == 1) && (j != 1)) {
                        c = dump[0].substr(i-1,1) + '.' + c;
                } else {
                        c = dump[0].substr(i-1,1) + c;
                }
        }
        
        if(dump.length>1){
                if(dump[1].length>0){
                        c += ','+dump[1];
                }else{
                        c += ',';
                }
        }
        return c;
    } else {
        return '0';
    }
}

function dtfrommysql(waktu) {
    if ((waktu !== undefined) & (waktu !== null) & (waktu !== '')) {
        var el = waktu.split(' ');
        var tgl= formatTanggal(el[0]);
        var tm = el[1].split(':');
        return tgl+' '+tm[0]+':'+tm[1]+':'+tm[2];
    } else {
        return '-';
    }
    
}

function dttomysql(waktu){
    var el = waktu.split(' ');
    var tgl= date2mysql(el[0]);
    var tm = el[1].split(':');
    return tgl+' '+tm[0]+':'+tm[1];
}

function notif_warning(element, pesan){
    $(element).next().remove();
    $(element).after('<div class="invalid-feedback">'+pesan+'</div>');
}

function unotif_warning(element){
    $(element).next().remove();
    $(element).closest('.form-group').removeClass('has-error');
}

function printMe(url, param) {
    var wWidth = $(window).width();
    var dWidth = wWidth * 1;
    var wHeight= $(window).height();
    var dHeight= wHeight * 1;
    var x = screen.width/2 - dWidth/2;
    var y = screen.height/2 - dHeight/2;
    window.open(url+'/?'+param,'Cetak Penerimaan','width='+dWidth+', height='+dHeight+', left='+x+',top='+y);
}

function ceiling(num, pembulat) {
    var angka = parseFloat(num);
    var kelipatan = pembulat;
    var sisa = angka % kelipatan;
    if (sisa !== 0) {
        var kekurangan = kelipatan - sisa;
        var hasil = angka + kekurangan;
        return Math.ceil(hasil);
    } else {
        return Math.ceil(angka);
    }   
}

function add_success() {
    swal({
        position: 'top-end',
        type: 'success',
        title: 'Tambah',
        text: 'Berhasil tambah data.',
        showConfirmButton: false,
        timer: 1500
    });
}

function edit_success() {
    swal({
        position: 'top-end',
        type: 'success',
        title: 'Ubah',
        text: 'Berhasil ubah data.',
        showConfirmButton: false,
        timer: 1500
    });
}

function delete_success() {
    swal({
        position: 'top-end',
        type: 'success',
        title: 'Hapus',
        text: 'Berhasil hapus data.',
        showConfirmButton: false,
        timer: 1500
    });
}

function add_failed() {
    swal(
      'Tambah!',
      'Gagal tambah data.',
      'error'
    );
}

function edit_failed() {
    swal(
      'Ubah!',
      'Data gagal diubah.',
      'error'
    );
}

function delete_failed() {
    swal(
      'Hapus!',
      'Data gagal dihapus.',
      'error'
    );
}

function custom_message(title, message, type) {
    swal(
      ''+title+'',
      ''+message+'',
      ''+type+''
    );
}

function remove_validated(form_element)
{
    $(form_element).find("*").removeClass('is-invalid');
}


