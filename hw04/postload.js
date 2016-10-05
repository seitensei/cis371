'use strict';

function checkForm() {
    var docform = document.getElementById("mainform");
    var readout = document.getElementById("validationdata");
    var valtext = "Validation Failure:<br>"
    var valstat = false;
    var year = docform.y.value;
    var month = docform.m.value;
    var report = docform.r.value;
    var type = docform.t.value;
    if ((year < 1945 ) || year > 2007) {
        valstat = true;
        valtext = valtext + "Year must be within range of 1945 to 2007<br>";
    }
    if ((month < 1) || (month > 12)) {
        valstat = true;
        valtext = valtext + "Month is outside of real world range.<br>";
    }
    if ((year >= 2007) && (month > 8)) {
        valstat = true;
        valtext = valtext + "Specified date is outside of accessible data.<br>"
    }
    if (!((report == 1) || (report == 2))) {
        valstat = true;
        valtext = valtext + "Invalid option for report type. That isn't even a GUI option. I don't even.<br>"
    }
    if (!((report == 1) || (report == 2) || (report == 3))) {
        valstat = true;
        valtext = valtext + "Invalid option for temperature type. That isn't even a GUI option. I don't even.<br>"
    }

    if (valstat == true) {
        readout.innerHTML = valtext;
        return false;
    } else {
        return true;
    }
}