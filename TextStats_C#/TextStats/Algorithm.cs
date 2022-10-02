using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;

namespace CP
{
    // Assumptions; 
    //  Numeric and special characters are treated like space.
    //      "20th" is treated as the word "th".
    //      'I co-wrote' is treated as 3 words: 'I', 'co' and 'wrote'
    //  Words are to be treated as the uppercase version.
    //      'AMBIENT', 'Ambient' and 'ambient' are treated as "AMBIENT".
    //  Lower and upper case characters are not differentiated.
    //      'A' and 'a' are both 'A'.
    //      Special characters are ignored. Not interested in frequency of '-'.

    public class Algorithm
    {
        // To implement ..
        string textFile;
        string filePath;
                      
        IDictionary<char, int> CharDict = new Dictionary<char, int>();
        SortedDictionary<string, int> WordDict = new SortedDictionary<string, int>();//SortedDictionary
        public Algorithm(string text)
        {
            filePath = text;
            textFile = File.ReadAllText(text);            
        }

        public void FillCharDict()
        {
            #region(DictionarySetup)
            for(int i='A'; i <= 'Z';i++)
            {                
                CharDict.Add((char)i, 0);
            }
            #endregion
                        
        }

        public void GetCharFrequency()
        {

            FillCharDict();
            
            for (int i = 0; i < textFile.Length; i++)
            {
                               
                if (CharDict.ContainsKey(char.ToUpper(textFile[i])))
                {
                    CharDict[char.ToUpper(textFile[i])] += 1;
                }
            }
            
            Console.WriteLine("{0}" + "{1}", "Item", "       Frequency");
            foreach (var kvp in CharDict)
            {
                Console.WriteLine("{0}" + String.Concat(Enumerable.Repeat(" ", 14)) + "{1}", kvp.Key, kvp.Value);
            }
            Console.WriteLine("\n");
                        
        }

                              

        public void GetWordFrequency()
        {
            string line;
            string word = string.Empty;//empty to ensure no initial string is saved to the dictionary
            List<string> lineList = new List<string>();
            StreamReader sr = new StreamReader(filePath);
            
            while (!sr.EndOfStream)
            {
                line = sr.ReadLine();
                string lineUpper = line.ToUpper(); //capitalises all of the string
                lineList.Add(lineUpper); //adds to list so each line can be analyzed later
                                
            }
            sr.Close();

            
            
            for(int p = 0; p< lineList.Count; p++) //iterates through the lineList
            {
                string listLine = lineList[p];
                for (int i = 0; i < listLine.Length; i++)
                {

                    if (listLine[i] >= 'A' && listLine[i] <= 'Z')
                    {
                        word += listLine[i]; //if the character is a letter it adds it on to the string word
                        
                    }
                    else 
                    {
                        if (!WordDict.ContainsKey(word) && word != string.Empty) //check to make sure the dictionary doesnt already contain the word
                        {
                            WordDict.Add(word, 1); //if not add the word as a key with a value of one
                            word = string.Empty; //reset the variable word to empty ready for the next character
                        }
                        else if(word != string.Empty)
                        {
                            WordDict[word] += 1; //increase the value by one
                            word = string.Empty; //reset the variable word to empty
                        }
                    }
                }
            }


            Console.WriteLine("{0}" + "{1}", "Item", "       Frequency");
            foreach (var kvp in WordDict)
            {
                int lengthOfKey = kvp.Key.Length;
                int lengthOfGap = 15 - lengthOfKey;//calculation to ensure univorm location of count on console to make it easier to read for the user

                Console.WriteLine("{0}"+ String.Concat(Enumerable.Repeat(" ", lengthOfGap)) + "{1}", kvp.Key, kvp.Value);
            }
                       
                        
        }

        public void TextFileOutput(string filePath)//method to print the results to a text file
        {
            try
            {
                StreamWriter sw = new StreamWriter(filePath, true);
                sw.WriteLine("{0}" + "{1}", "Item", "       Frequency");
                foreach (var kvp in CharDict)
                {
                    sw.WriteLine("{0}" + String.Concat(Enumerable.Repeat(" ", 14)) + "{1}", kvp.Key, kvp.Value);
                }
                sw.WriteLine("\n");
                sw.WriteLine("{0}" + "{1}", "Item", "       Frequency");
                foreach (var kvp in WordDict)
                {
                    int lengthOfKey = kvp.Key.Length;
                    int lengthOfGap = 15 - lengthOfKey;//calculation to ensure univorm location of count on console to make it easier to read for the user

                    sw.WriteLine("{0}" + String.Concat(Enumerable.Repeat(" ", lengthOfGap)) + "{1}", kvp.Key, kvp.Value);

                }
                sw.Close();
            }
            catch
            {
                Console.WriteLine("Error in file writing, check file path and security permissions");
            }
            
        }
    
    
    }
}
