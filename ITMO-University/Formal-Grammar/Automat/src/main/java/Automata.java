import java.io.IOException;
import java.io.InputStreamReader;
import java.io.BufferedReader;

public class Automata {
    public static void main(String[] args) throws IOException {
        BufferedReader read = new BufferedReader(new InputStreamReader(System.in));
        String input = read.readLine();

        if (new Matcher(input).isMatches()){
            System.out.println("Match");
        }
    }
}
