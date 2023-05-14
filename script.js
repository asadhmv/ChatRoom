if(document.getElementById("canvas1")!= null)
{
    canvas = document.getElementById("canvas1");
    ctx = canvas.getContext('2d');
    canvas.width = innerWidth - 20;
    canvas.height = innerHeight;
    size_ = 1.3;
}
else if(document.getElementById("canvas_connexion") != null)
{
    canvas = document.getElementById("canvas_connexion");
    ctx = canvas.getContext('2d');
    canvas.width = window.innerWidth/2;
    canvas.height = window.innerHeight;
    size_ = 3.5;
}
else if(document.getElementById("canvas_inscription") != null)
{
    canvas = document.getElementById("canvas_inscription");
    ctx = canvas.getContext('2d');
    canvas.width = 2*window.innerWidth/3;
    canvas.height = window.innerHeight;
    size_ = 3.5;
}
console.log(document.getElementById("canvas1"));
console.log(document.getElementById("canvas_connexion"));
console.log(document.getElementById("canvas_inscription"));
console.log(ctx);




let logo = new Image();
logo.src = "newlogo.png";
ctx.drawImage(logo,0,0);

let particlesArray;

//get mouse position
let mouse = {
    x: null,
    y: null,
    radius: (canvas.height/80) * (canvas.width/80)
};

window.addEventListener('mousemouve',
    function(event){
        mouse.x = event.x;
        mouse.y = event.y;
    }
)

//create particle
class Particle{
    constructor(x, y, directionX, directionY, size, color) {
        this.x = x;
        this.y = y;
        this.directionX = directionX;
        this.directionY = directionY;
        this.size = size;
        this.color = color;
    }

    //method to draw individual particle
    draw(){
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2, false);
        ctx.fillStyle = this.color;
        ctx.fill();
    }
    //check particle position, check mouse position, move the particle, draw the particle
    update(){
        //check if the particle is still within canvas
        if(this.x > canvas.width || this.x < 0){
            this.directionX = -this.directionX;
        }
        if(this.y > canvas.height || this.y < 0){
            this.directionY = -this.directionY;
        }

        //check collision direction - mouse position / particle position
        let dx = mouse.x -this.x;
        let dy = mouse.y -this.y;
        let distance = Math.sqrt(dx*dx + dy*dy);
        if(distance < mouse.radius + this.size){
            if(mouse.x < this.x && this.x < canvas.width -this.size * 10){
                this.x += 10;
            }
            if(mouse.x > this.x && this.x > this.size * 10){
                this.x -= 10;
            }
            if(mouse.y < this.y && this.y < canvas.height -this.size * 10){
                this.y += 10;
            }
            if(mouse.y > this.y && this.y > this.size * 10){
                this.y -= 10;
            }
        }
        //move the particle
        this.x += this.directionX;
        this.y += this.directionY;
        this.draw();
    }
} 

//Randomiser l'apparition des particules
function init(){
    particlesArray = [];
    let numberOfParticules = (canvas.height * canvas.width) / 9000;
    for(let i=0; i<numberOfParticules * size_; i++)
    {
        let size = (Math.random() * 5) + 1;
        let x = (Math.random() * ((innerWidth - size * 2) -(size * 2)) + size * 2);
        let y = (Math.random() * ((innerHeight - size * 2) -(size * 2)) + size * 2);
        let directionX = (Math.random() * 5) - 2.5;
        let directionY = (Math.random() * 5) - 2.5;
        let bleu = '#26caf8';
        let violet = '#c625d0'
        let blanc = '#ffffff';
        let colors = [bleu, violet, blanc];
        let random_color = colors[Math.floor(Math.random()*colors.length)];

        particlesArray.push(new Particle(x, y, directionX, directionY, size, bleu));
    }
}

//si les particules sont assez proches alors on les connecte
function connect(){
    let opacityValue = 1;
    for(let a=0 ; a<particlesArray.length ; a++)
    {
        for(let b=a ; b<particlesArray.length ; b++)
        {
            let distance = ((particlesArray[a].x - particlesArray[b].x) * (particlesArray[a].x - particlesArray[b].x)) + ((particlesArray[a].y - particlesArray[b].y) * (particlesArray[a].y - particlesArray[b].y));
            //let distance = Math.sqrt(Math.sqaure(particlesArray[b].x - particlesArray[a].x) + Math.sqaure(particlesArray[b].y - particlesArray[a].y));
            if (distance < (canvas.height/7) * (canvas.width/7))
            {
                opacityValue = 1 - (distance/20000);
                ctx.strokeStyle = 'rgba(15,150,160,' + opacityValue + ')';
                ctx.lineWidth = 1;
                ctx.beginPath();
                ctx.moveTo(particlesArray[a].x, particlesArray[a].y);
                ctx.lineTo(particlesArray[b].x, particlesArray[b].y);
                ctx.stroke();
            }
        }
    }
}

//boucle d'animation
function animate(){
    requestAnimationFrame(animate);
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    for( let i=0 ; i<particlesArray.length ; i++)
    {
        particlesArray[i].update();
    }
    connect();
    let logo = new Image();
    logo.src = "../PNG/image.png";
    let posX = canvas.width/2 - logo.width/2;
    let posY = canvas.height/2 - logo.height/2;
    ctx.drawImage(logo,posX,posY);
}

window.addEventListener('resize',
    function(){
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        size_ = 1;
        mouse.radius = ((canvas.height/80) * (canvas.height/80));
        init();
    }
)

window.addEventListener('mouseout',
    function(){
        mouse.x = undefined;
        mouse.x = undefined;
    }
)

init();
animate();