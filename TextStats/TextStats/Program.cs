using System;
using System.IO;
using System.Resources;

namespace CP
{
    class Program
    {
        static void Main(string[] args)
        {   // Path to testFile.txt must be changed to your download
            Algorithm algorithm = new 
                Algorithm(@"C:\Users\eddim\Desktop\Uni 2021\Programming\Assessment\TextStats\TextStats\testfile.txt");
            
                
            algorithm.GetCharFrequency();
            algorithm.GetWordFrequency();
            algorithm.TextFileOutput(@"C:\Users\eddim\Desktop\Uni 2021\Programming\Assessment\TextStats\TextStats\outputText.txt"); //additional method to print out the result to an external txt file


            Console.WriteLine("Hello World!");
        }
    }
}
