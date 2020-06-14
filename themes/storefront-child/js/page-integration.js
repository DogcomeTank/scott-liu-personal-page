var dialRotate = 0;
var fillArmRotate = 0;
var dialAndFillSettings = JSON.parse(dialFillSettings.settings);
var setTime = 0;
var setTimeInterval = 40;
var setTimeIntervalFast = 20;
var stopBtn = false;
var rotateStep = .1;


jQuery(document).ready(function () {
    jQuery('#run-btn').click(function () {
        autoRun(dialAndFillSettings);
    });
    jQuery('#stop-btn').click(function () {
        stopBtn = true;
    });
    jQuery('#reset-btn').click(function () {
        resetBtnPressed();
    });
});



// **********


async function autoRun(array) {

    jQuery('#run-btn').prop('disabled', true);
    stopBtn = false;

    if (jQuery("#run-btn").hasClass("w3-green")) {
        jQuery("#run-btn").removeClass("w3-green").addClass('w3-grey');
    }

    for (const item of array) {
        // Run btn pressed
        //Dial rotation start
        while (item.dial_rotation <= dialRotate && !stopBtn) {
            await DialAutoRunDelayed('ccw');
        }
        while (item.dial_rotation >= dialRotate && !stopBtn) {
            await DialAutoRunDelayed('cw');
        }

        // fill arm rotation start
        while (item.fill_rotation <= fillArmRotate && !stopBtn) {
            await FillArmAutoRunDelayed('ccw');
        }
        while (item.fill_rotation >= fillArmRotate && !stopBtn) {
            await FillArmAutoRunDelayed('cw');
        }

    }

    jQuery('#run-btn').prop('disabled', false);
    if (jQuery("#run-btn").hasClass("w3-grey")) {
        jQuery("#run-btn").removeClass("w3-grey").addClass('w3-green');
    }
}

async function ResetDelayed() {


    if (dialRotate.toFixed(2) < 0) {
        dialRotate += rotateStep;
        rotate('dial', dialRotate);
        await delay(setTimeIntervalFast);
    }else if(dialRotate.toFixed(2) > 0){
        dialRotate -= rotateStep;
        rotate('dial', dialRotate);
        await delay(setTimeIntervalFast);
    }
    if (fillArmRotate.toFixed(2) < 0) {
        fillArmRotate += rotateStep;
        rotate('fill-arm', fillArmRotate);
        await delay(setTimeIntervalFast);
    }else if(fillArmRotate.toFixed(2) > 0){
        fillArmRotate -= rotateStep;
        rotate('fill-arm', fillArmRotate);
        await delay(setTimeIntervalFast);
    }
}
async function resetBtnPressed() {
    while (dialRotate <= 0 || fillArmRotate <=0) {
        await ResetDelayed();
    }
}

async function DialAutoRunDelayed(direction) {
    // notice that we can await a function
    // that returns a promise
    if (direction == 'ccw') {
        dialRotate -= rotateStep;
        rotate('dial', dialRotate);
        await delay();
    } else {
        dialRotate += rotateStep;
        rotate('dial', dialRotate);
        await delay();
    }
}

async function FillArmAutoRunDelayed(direction = "ccw") {
    // notice that we can await a function
    // that returns a promise
    if (direction == 'ccw') {
        fillArmRotate -= rotateStep;
        rotate('fill-arm', fillArmRotate);
        await delay();
    } else {
        fillArmRotate += rotateStep;
        rotate('fill-arm', fillArmRotate);
        await delay();
    }

}

async function resetBtn(currentPosition) {

    jQuery('#run-btn').prop('disabled', true);

    if (jQuery("#run-btn").hasClass("w3-green")) {
        jQuery("#run-btn").removeClass("w3-green").addClass('w3-grey');
    }

    for (const item of array) {
        if (!stopBtn) {
            await AutoRunDelayed(item);
        } else {
            // if stop button pressed, stop the operation
            stopBtn = false;
            break;
        }
    }

    jQuery('#run-btn').prop('disabled', false);
    if (jQuery("#run-btn").hasClass("w3-grey")) {
        jQuery("#run-btn").removeClass("w3-grey").addClass('w3-green');
    }

}

function delay(time = setTimeInterval) {
    return new Promise(resolve => setTimeout(resolve, time));
}
//******* */




// Btn Events
jQuery("#dial-ccw-slow-btn").click(function () {
    dialRotate -= .2;
    rotate("dial", dialRotate);
});

jQuery("#fill-ccw-slow-btn").click(function () {
    fillArmRotate -= .2;
    rotate("fill-arm", fillArmRotate);
});

jQuery("#dial-ccw-fast-btn").click(function () {
    dialRotate -= 1;
    rotate("dial", dialRotate);
});

jQuery("#fill-ccw-fast-btn").click(function () {
    fillArmRotate -= 1;
    rotate("fill-arm", fillArmRotate);
});


// CW btn
jQuery("#dial-cw-slow-btn").click(function () {
    dialRotate += .2;
    rotate("dial", dialRotate);
});

jQuery("#fill-cw-slow-btn").click(function () {
    fillArmRotate += .2;
    rotate("fill-arm", fillArmRotate);
});

jQuery("#dial-cw-fast-btn").click(function () {
    dialRotate += 1;
    rotate("dial", dialRotate);
});

jQuery("#fill-cw-fast-btn").click(function () {
    fillArmRotate += 1;
    rotate("fill-arm", fillArmRotate);
});

function rotate(componentName, rotation, direction = 'ccw') {

    dialRotate.toFixed(4);
    fillArmRotate.toFixed(4);

    var component = document.getElementById(componentName);

    component.setAttribute('style', 'transform:rotate(' + rotation + 'deg)');

    // display the rotation angle
    if (componentName == 'dial') {
        jQuery('#dial-rotation').html(dialRotate.toFixed(4));
    } else if (componentName == 'fill-arm') {
        jQuery('#fill-arm-rotation').html(fillArmRotate.toFixed(4));
    }

}


async function AutoRotate(imageName, rotation) {

    dialRotate.toFixed(4);
    fillArmRotate.toFixed(4);

    var img = document.getElementById(imageName);

    img.setAttribute('style', 'transform:rotate(' + rotation + 'deg)');

    // display the rotation angle
    if (imageName == 'dial') {
        jQuery('#dial-rotation').html(dialRotate.toFixed(4));
    } else if (imageName == 'fill-arm') {
        jQuery('#fill-arm-rotation').html(fillArmRotate.toFixed(4));
    }

}