#include <iostream>
#include <ctime>

using namespace std;//this allows me to leave out the std namespace (namespaces are used to avoid conflict between code with the same name), it also lets us leave out the :: scope operator, which in the case below is telling the complier to check for code in the namespace (look for cout)

void PrintIntroduction(int Difficulty)
{
    //story print out
    std::cout << "\n\nYou are the navigation officer aboard the starship Anubis." << std::endl;
    cout << "Your ship has been attacked by pirates and forced to commit a random shock drop (FTL jump)." << endl;//by stating 'using namespace std;' above main i can avoid writing std:: as it is implyed
    std::cout << "Unfortunately the Nav computer was damaged and only displays fragmented information. It displays that it is a Level " << Difficulty << " calculation." << std::endl << endl;
    
    std::cout << "By deciphering the following clues calculate the Anubis coordinates to continue your long journey..." << std::endl << endl;
}

bool PlayGame(int Difficulty)
{
    PrintIntroduction(Difficulty);


    const int ConstExample = 4;//const int indicates the int a cannot be changed later in the code the value is fixed to 4
    int CoordinateX = (rand() % Difficulty) + Difficulty; 
    int CoordinateY = (rand() % Difficulty) + Difficulty;
    int CoordinateZ = (rand() % Difficulty) + Difficulty;

    /*
    multi line comment

    */

    const int CoordinateSum = CoordinateX + CoordinateY + CoordinateZ;
    const int CoordinateProd = CoordinateX * CoordinateY * CoordinateZ;

    //hints print out
    cout << "The coordinate fragment are made up of three numbers" << endl;
    cout << "The three coordinates multiply together to give: " << CoordinateProd << endl;
    cout << "The three coordinates add together to give: " << CoordinateSum<< endl;
    cout << "Please submit your answer in this format: X X X"<< endl;

    int PlayerGuessX; 
    int PlayerGuessY;
    int PlayerGuessZ;

    cout << endl;
    cin >> PlayerGuessX >> PlayerGuessY >> PlayerGuessZ; //cin will only ask for more inputs when the input stream is empty, so if the user inputs 1 2 3 with spaces cin will assign 1 2 3 to X Y Z.
    cout << endl;
    cout << "You entered: " << PlayerGuessX << " " << PlayerGuessY << " " << PlayerGuessZ << endl;

    int GuessSum = PlayerGuessX + PlayerGuessY + PlayerGuessZ;
    int GuessProd = PlayerGuessX * PlayerGuessY * PlayerGuessZ;

    //Check players guess
    if ((CoordinateProd == GuessProd) && (CoordinateSum == GuessSum)){
        
        if (Difficulty == 5)
        {
            cout << "\n\nThe Anubis shudders as the drive once again spins up and drops into the desolate zone." << endl;
            cout << " Seconds latter a loud crack echos through the ship and the black starless void of the desolate zone is instantly replaced by millions of stars and planets. The radio crackles to life" << endl;
            cout << "\"MSV Anubis, this is Castillo Traffic Control. We've been expecting you guys for quite some time, everything ok?\"" << endl;
            cout << " Well done you've plotted the Anubis home and saved its crew" << endl;
        }else{
            cout << "\n\nCongratulations you have correctly determined the ships location and can now continue to the next shock jump.\n"; //\n escape sequence can be used instead of endl;
            return true;
        }
        
        
    }else{
        cout << "\n\nThe navigation computer flashes red as a computerised voice echoes throughout the bridge \"Warning! Location data error! Unable to calculate sutible jump vector, please try again\""; // \" is an escape sequence, it allows me to print out double quotes without closing the string
        return false;
    }

 

}

int main()
{   
    srand(time(NULL)); //seeding rand function based on the time of day (ensure the random numbers are always different)

    int const MaxLevel = 5;
    int LevelDifficulty = 1;

    while(MaxLevel >= LevelDifficulty)
    {
        bool bLevelCompleate = PlayGame(LevelDifficulty);
        
        cin.clear(); //clears any errors
        cin.ignore();// Discards the buffer
        
        if (bLevelCompleate)
        {
            ++LevelDifficulty; //increase level difficulty
        }
        

    }
    
    return 0;
}