/*
Грамматика
S -> cA | bbAB | a 
B -> bbbB’
B’ -> BBbB’ | eps
A -> aA | c
*/

#include <iostream>
using namespace std;

void getting_char();
void S();
void A();
void B();
void B_recursive();

char c;


int main() 
{
    try
    {
        getting_char();
        S();
        if (c != '.' ) throw c;
        cout << "Recognition completed successfully!" << endl;
        return 0;
    }
    catch (char c)
    {
        cout << "Error: Chain not recognized!"<< "Invalid character: " << c << endl;
        return 1;
    }
}


void getting_char()
{
    cin >> c;    
}

void B_recursive()
{   
    cout << "B’-> BBbB’" << endl;
    B();
    B();
    if (c == 'b')
    {
        cout << "-> bB’" << endl;
        getting_char();
        B_recursive();
    } else throw c;
}

void B()
{
    if (c == 'b')
    {
        cout << "B-> bbbB" << endl;
        getting_char();
        
    } else throw c;
    if (c == 'b')
    {
        getting_char();
            
    } else throw c;
    if (c == 'b')
    {
        getting_char();
        B_recursive();
    } else throw c;
}

void A()
{
    if(c == 'a')
    {
        cout << "A-> aA" << endl;
        getting_char();
        A();
    } else 
    if(c == 'c')
    {
        cout << "A-> c" << endl;
        getting_char();
    } else throw c;
} 


void S()
{    
    if(c == 'a')
    {
        cout << "S-> a" << endl;
        getting_char();
    } else 
    if(c == 'c')
    {
        cout << "S-> cA" << endl;
        getting_char();
        A();
    } else 
    if(c == 'b')
    {
      cout << "S-> bbAB" << endl;
      getting_char();
      if(c == 'b')
      {
        getting_char();
        A();
        B();
      } else throw c;
    } else throw c;
}
