class Shark
{
  PImage leftShark, rightShark;
  int x;
  int y;
  int dx = 1;
  int dy = 1;
  int sharkCounter = 0; //used to time how long the shark is in one position
  
  //constructor
  Shark(int x, int y)
  {
    this.x = x;
    this.y = y;
    
    
    leftShark = loadImage("SharkLeft.png");
    leftShark.resize(250, 0);
    rightShark = loadImage("SharkRight.png");
  
  }
  
  void update()
  {
    randomPosition();
    render();
    move();
    sharkCounter +=1;
  }
  
  void render()
  {
    if (x<300)
    {
      
      image(leftShark, x, y);
      
    }
    if(x>300)
    {
      image(rightShark, x, y);
    }
  }
  
  void move()
  {
    if ( y > 670)
    {
     y = y-dy;
    }
            
  }
  

  //gives the shark a random position on the bottom of the screen
  void randomPosition()
  {
     if (sharkCounter == 300)
    {          
       int r = int(random(100, 300));
       sharkCounter = 0;
       x = r;
    
    }
  }
}
      
    
  