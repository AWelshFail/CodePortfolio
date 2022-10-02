Boat player1;
TNT tnt1;
Shark shark1;
SharkBullet sharkBullet1;
Fish[][] morefish = new Fish[5][5];
PImage bloodSplat;
color TNT1 = color(255, 0, 0);
color BOAT = color(204, 102, 0);
int PLAY = 0;
int FINISHED = 1;
int gameMode = PLAY;
int x =50;
int y =550;
int Score = 0;


boolean sharkFire = false; //boolean to control shark bubble


void setup() {
  size(600, 800);
  background(119, 210, 255);
  fill(0, 135, 253);
  rect(-2, 100, 610, 810);
  
  player1 = new Boat(300);
  tnt1 = new TNT();
  shark1 = new Shark(100 ,800);
  sharkBullet1 = new SharkBullet();

  for (int rows = 0; rows < morefish.length; rows++) {

    for (int columns = 0; columns < morefish[rows].length; columns++) {
      morefish[rows][columns] = new Fish(x, y);
      x+=50; //move to next coloumn
    }

    x = 50;
    y+=50;
  }
}

void draw() {
  if (gameMode == PLAY) {
    background(119, 210, 255);
    fill(0, 135, 253);
    rect(-2, 100, 610, 810);
    player1.update();
    tnt1.update();
    sharkBullet1.update();
    
    
     
    
    if (Score >= 150){ //used so the shark appears after the player has gotten a few fish
    shark1.update();
    
    bulletFire();
    
    }
    
    
    

    for (int rows =0; rows < morefish.length; rows++) {
      for (int columns = 0; columns < morefish[rows].length; columns++) {
        
        if (morefish[rows][columns] != null) 
        {
          morefish[rows][columns].update();

          if (morefish[rows][columns].crash() == true && tnt1.firing == true)
          {
            if (morefish[rows][columns] != null) 
          {
              morefish[rows][columns] = null;
              Score = Score + 50;
              
           }
            tnt1.firing = false;
            tnt1.speed = -10;
            tnt1.y = tnt1.y + tnt1.speed;
           // tnt1.x = -25;
           
          
        } else {
        morefish[rows][columns].update();
      }
        }
        if (morefish[rows][columns] != null) {
          if (morefish[rows][columns].boatCrash()==true || sharkBullet1.boatCrash()==true || Score >= 1200)
          {
            
            gameMode = FINISHED;
            gameOver(); //gameover splashscreen
          }
        }
      }
    }
  } else {
   gameOver(); 
  }

  if (gameMode == FINISHED)
  {
    if (keyPressed)
    {
      if (key == ENTER)
      {
        
        gameMode = PLAY;
        Score = 0;
        setup();
        
      }
    }
  }
}



void bulletFire() {
  
  if (sharkFire == false)
  {
    sharkBullet1.StartLocation(shark1.x + 120, shark1.y+100);
    sharkFire = true;
    
     
    
  }
  
  
  
}

void gameOver() { //gameover screen

  bloodSplat = loadImage("Bloodsplatter.jpg");
  bloodSplat.resize(width, height);
  image(bloodSplat, 0, 0);
  textSize(32);
  fill(0, 0, 0);
  text("Game Over", 240, 200);
  text("Score: " + Score, 240, 240);
  textSize(16);
  text("Press enter to play again", 235, 255);
}

void keyPressed() {
  if (key == CODED) {
    if (keyCode == LEFT && player1.x>= 20 && tnt1.firing == false && tnt1.returning == false) {
      player1.x = player1.x -10;
    } else if (keyCode == RIGHT && player1.x <= 510&& tnt1.firing == false && tnt1.returning == false ) {
      player1.x +=10;
    }
  }

  if (key == CODED) {
    if (keyCode == DOWN) {
      tnt1.startLocation(player1.x +59, player1.y -50);
    }
  }
}