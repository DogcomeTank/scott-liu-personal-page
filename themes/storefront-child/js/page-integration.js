var dialRotate = 0;
var fillArmRotate = 0;


jQuery("#dial-ccw-slow-btn").click(function(){
    dialRotate -= .2;
    rotate("dial", dialRotate);
});

jQuery("#fill-ccw-slow-btn").click(function(){
    fillArmRotate -= .2;
    rotate("fill-arm", fillArmRotate);
});

jQuery("#dial-ccw-fast-btn").click(function(){
    dialRotate -= 1;
    rotate("dial", dialRotate);
});

jQuery("#fill-ccw-fast-btn").click(function(){
    fillArmRotate -= 1;
    rotate("fill-arm", fillArmRotate);
});


// CW btn
jQuery("#dial-cw-slow-btn").click(function(){
    dialRotate += .2;
    rotate("dial", dialRotate);
});

jQuery("#fill-cw-slow-btn").click(function(){
    fillArmRotate += .2;
    rotate("fill-arm", fillArmRotate);
});

jQuery("#dial-cw-fast-btn").click(function(){
    dialRotate += 1;
    rotate("dial", dialRotate);
});

jQuery("#fill-cw-fast-btn").click(function(){
    fillArmRotate += 1;
    rotate("fill-arm", fillArmRotate);
});



function rotate(imageName, rotation){

    dialRotate.toFixed(4);
    fillArmRotate.toFixed(4);

    var img=document.getElementById(imageName);

    img.setAttribute('style','transform:rotate('+rotation+'deg)');

    // display the rotation angle
    if(imageName == 'dial'){
        jQuery('#dial-rotation').html(dialRotate.toFixed(4));
    }else if(imageName == 'fill-arm'){
        jQuery('#fill-arm-rotation').html(fillArmRotate.toFixed(4));
    }

}