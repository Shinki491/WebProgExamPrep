const canvas = document.querySelector("canvas");
const ctx = canvas.getContext("2d");

const mage = {
  x: 200,
  y: 400,
  width: 100,
  height: 100,
  img: new Image(),
};

const target = {
  x: 0,
  vx: 50,
  y: 50,
  width: 40,
  height: 60,
  rootedUntil: null,
  img: new Image(),
};

mage.img.src = "mage.png";
target.img.src = "target.png";

function render() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);
}

function update(dt) {
}

let last = performance.now();

function next() {
  const now = performance.now();
  const dt = (now - last) / 1000;
  update(dt);
  render();
  last = now;
  requestAnimationFrame(next);
}

next();

function getInitialProjectileData(e) {
  return {
    x: 250,
    y: 400,
    r: 15,
    vx:
      300 *
      Math.cos(Math.atan((400 - e.offsetY) / (250 - e.offsetX))) *
      (e.offsetX < 250 ? -1 : 1),
    vy:
      300 *
      Math.sin(Math.atan((400 - e.offsetY) / (250 - e.offsetX))) *
      (e.offsetX < 250 ? -1 : 1),
  };
}

function checkCollision(circle, rectangle) {
  const closestX = Math.max(
    rectangle.x,
    Math.min(circle.x, rectangle.x + rectangle.width)
  );
  const closestY = Math.max(
    rectangle.y,
    Math.min(circle.y, rectangle.y + rectangle.height)
  );
  const distanceX = circle.x - closestX;
  const distanceY = circle.y - closestY;
  return distanceX ** 2 + distanceY ** 2 <= circle.r ** 2;
}


///ADDED 



// a. Draw rectangles (or images) for mage and target
function render() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  // Draw mage
  ctx.drawImage(mage.img, mage.x, mage.y, mage.width, mage.height);

  // Draw target
  ctx.drawImage(target.img, target.x, target.y, target.width, target.height);

  // Draw projectiles
  projectiles.forEach((proj) => {
    ctx.beginPath();
    ctx.arc(proj.x, proj.y, proj.r, 0, Math.PI * 2);
    ctx.fill();
  });

  // Draw line when mouse moves
  if (mouseOverCanvas) {
    ctx.beginPath();
    ctx.moveTo(250, 400);
    ctx.lineTo(mousePos.x, mousePos.y);
    ctx.stroke();
  }
}

// b. Move target and c. Reverse direction at edges
function update(dt) {
  if (!target.rootedUntil || performance.now() > target.rootedUntil) {
    target.x += target.vx * dt;

    if (target.x <= 0 || target.x + target.width >= canvas.width) {
      target.vx *= -1;
    }
  }

  // Move projectiles
  projectiles.forEach((proj) => {
    proj.x += proj.vx * dt;
    proj.y += proj.vy * dt;

    // Check collision with target
    if (checkCollision(proj, target)) {
      projectiles = projectiles.filter((p) => p !== proj); // Remove projectile
      target.rootedUntil = performance.now() + 3000; // Root target for 3 seconds
    }
  });

  // Remove off-screen projectiles
  projectiles = projectiles.filter(
    (proj) => proj.x >= 0 && proj.x <= canvas.width && proj.y >= 0 && proj.y <= canvas.height
  );
}

// d. Draw line while mouse moves over canvas
let mousePos = { x: 0, y: 0 };
let mouseOverCanvas = false;

canvas.addEventListener("mousemove", (e) => {
  mousePos = { x: e.offsetX, y: e.offsetY };
  mouseOverCanvas = true;
});

canvas.addEventListener("mouseleave", () => {
  mouseOverCanvas = false;
});

// e. Launch projectile on click
let projectiles = [];
let lastFired = 0;

canvas.addEventListener("click", (e) => {
  const now = performance.now();

  // g. Restrict firing to every 2 seconds
  if (now - lastFired >= 2000) {
    projectiles.push(getInitialProjectileData(e));
    lastFired = now;
  }
});
