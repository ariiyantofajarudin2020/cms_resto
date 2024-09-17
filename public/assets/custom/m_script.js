function select_kat2(v) {
  if (v.checked) {
    document.getElementById('table_kat2').style.display = '';
  } else {
    document.getElementById('table_kat2').style.display = 'none';
    document.getElementById('k2f1').checked = false;
    document.getElementById('k2f2').checked = false;
    document.getElementById('k2f3').checked = false;
    document.getElementById('k2f4').checked = false;
    document.getElementById('k2f5').checked = false;
    document.getElementById('k2f6').checked = false;
    document.getElementById('k2f7').checked = false;
  }
}

function select_kat3(v) {
  if (v.checked) {
    document.getElementById('table_kat3').style.display = '';
  } else {
    document.getElementById('table_kat3').style.display = 'none';
    document.getElementById('k3f1').checked = false;
    document.getElementById('k3f2').checked = false;
    document.getElementById('k3f3').checked = false;
    document.getElementById('k3f4').checked = false;
    document.getElementById('k3f5').checked = false;
    document.getElementById('k3f6').checked = false;
    document.getElementById('k3f7').checked = false;
    document.getElementById('k3f8').checked = false;
    document.getElementById('k3f9').checked = false;
    document.getElementById('k3f10').checked = false;
    document.getElementById('k3f11').checked = false;
    document.getElementById('k3f12').checked = false;
    document.getElementById('k3f13').checked = false;
    document.getElementById('k3f14').checked = false;
    document.getElementById('k3f15').checked = false;
    document.getElementById('k3f16').checked = false;
    document.getElementById('k3f17').checked = false;
    document.getElementById('k3f18').checked = false;
    document.getElementById('k3f19').checked = false;
    document.getElementById('k3f20').checked = false;
    document.getElementById('k3f21').checked = false;
    document.getElementById('k3f22').checked = false;
    document.getElementById('k3f23').checked = false;
    document.getElementById('k3f24').checked = false;
    document.getElementById('k3f25').checked = false;
    document.getElementById('k3f26').checked = false;
    document.getElementById('k3f27').checked = false;
    
  }
}

function select_kat4(v) {
  if (v.checked) {
    document.getElementById('table_kat4').style.display = '';
  } else {
    document.getElementById('table_kat4').style.display = 'none';
    document.getElementById('k4f1').checked = false;
    document.getElementById('k4f2').checked = false;
    document.getElementById('k4f3').checked = false;
    document.getElementById('k4f4').checked = false;
    document.getElementById('k4f5').checked = false;
    document.getElementById('k4f6').checked = false;
    document.getElementById('k4f7').checked = false;
    document.getElementById('k4f8').checked = false;
    document.getElementById('k4f9').checked = false;
  }
}

function posgroup(v) {
  if (v.checked) {
    document.getElementById('k3f1').checked = true;
    document.getElementById('k3f2').checked = true;
    document.getElementById('k3f3').checked = true;
    document.getElementById('k3f13').checked = true;
    document.getElementById('k3f14').checked = true;
  }else{
    document.getElementById('k3f1').checked = false;
    document.getElementById('k3f2').checked = false;
    document.getElementById('k3f3').checked = false;
    document.getElementById('k3f13').checked = false;
    document.getElementById('k3f14').checked = false;
  
  }
}