/***********************************************
*           script transition login
************************************************/
  

    document.querySelector(".registerPart").hidden = true;
    let cacheColor = document.querySelector(".cacheColor"); 
    let registerPart = document.querySelector(".registerPart");
    let loginPart = document.querySelector(".loginPart");

    registerPart.addEventListener("click", function(){
      cacheColor.classList.toggle("rightSlide");
      document.querySelector(".registerPart").hidden = true;
      document.querySelector(".loginPart").hidden = false;
      document.querySelector(".child1").hidden = true;
      document.querySelector(".child3").hidden = false;

    });

    loginPart.addEventListener("click", function(){
      document.querySelector(".registerPart").hidden = false;
      cacheColor.classList.toggle("rightSlide");
      document.querySelector(".loginPart").hidden = true;
      document.querySelector(".child1").hidden = false;
      document.querySelector(".child3").hidden = false;
    });

/***********************************************
*                      CANVAS
************************************************/

 
    let c = document.getElementById('canvasConnexion');
    let ctx = c.getContext('2d');
    ctx.beginPath();
    ctx.moveTo(140,80);
    ctx.lineTo(140,120);
    ctx.lineTo(220,140);
    ctx.closePath();
    ctx.fillStyle = "#FCA311";
    ctx.fill();

    ctx.beginPath();
    ctx.moveTo(420,120);
    ctx.lineTo(380,220);
    ctx.lineTo(480,200);
    ctx.closePath();
    ctx.fillStyle = "#FCA311";
    ctx.fill();

    ctx.beginPath();
    ctx.moveTo(100,260);
    ctx.lineTo(120,280);
    ctx.lineTo(200,280);
    ctx.lineTo(180,260);
    ctx.closePath();
    ctx.fillStyle = "#FCA311";
    ctx.fill();

    ctx.beginPath();
    ctx.arc(320,400,80,0,Math.PI,true);
    ctx.fillStyle = "#FCA311";
    ctx.fill();

    ctx.beginPath();
    ctx.moveTo(300,20);
    ctx.lineTo(280,50);
    ctx.lineTo(300,80);
    ctx.lineTo(320,50);
    ctx.closePath();
    ctx.fillStyle = "#FCA311";
    ctx.fill();

dataUrl = canvas.toDataURL();
document.getElementById('canvasConnexion').style.b

