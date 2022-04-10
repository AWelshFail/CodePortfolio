
int position;
class Fish {

  PImage leftFish, rightFish;
  int x;
  int y;
  int dx = 1;
  int dy =50;
  int i;

  //constructor
  Fish(int x, int y)
  {
    this.x = x;
    this.y = y;

    leftFish = loadImage("FishLeft.png");
    leftFish.resize(50, 0);
    rightFish = loadImage("FishRight.png");
    rightFish.resize(50, 0);
    
    
  }

  void update()
  {
    render();
    move();
  }

  void render()
  {
    
    if (dx == -1)
      image(leftFish, x, y);

    if (dx == 1)
      image(rightFish, x, y);
  }

  void move()
  {
    if (x<=20) {
      dx=1; 
      y= y-dy;
    }

    if (x>=520) {
      dx = -1;
      y= y-dy;
    }

    x= x+dx;
    
    
  }
  
  //use to detect when fish have hit the player
  boolean boatCrash()
  {
    color detectedColour;
    for (int i=x; i<x + 50; i++)
    {

      detectedColour = get(i, y);
      //println(detectedColour);

      if (detectedColour == BOAT) {

        return true;
      }
    }
    return false;
  }

  //used to detect when fish has been hit by tnt
  boolean crash()
  {
    color detectedColour;
    for (int i=x; i<x + 50; i++)
    {
      position = get(x, y);
      detectedColour = get(i, y);
      //println(detectedColour);

      if (detectedColour == TNT1) {

        return true;
        
      }
    }
    return false;
  }
  

}