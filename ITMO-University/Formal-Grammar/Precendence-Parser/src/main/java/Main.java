import java.util.Scanner;
import java.util.Stack;

public class Main {
    static Stack<Character> stack = new Stack<>();
    // Правила грамматики
 /*   static String A = "aB"; // acbc
    static String alterA = "D";
    static String B = "CbB";
    static String alterB = "C";
    static String C = "c";
    static String alterC = "dAe";
    static String D = "B"; */


    // Матрица простого предшествования
    static char[][] matrix =
            {
                    {'-', 'A', 'B', 'D', 'C', 'a', 'b', 'c', 'd', 'e'},
                    {'A', '-', '-', '-', '-', '-', '-', '-', '-', '='},
                    {'B', '-', '-', '-', '-', '-', '-', '-', '-', '>'},
                    {'D', '-', '-', '-', '-', '-', '-', '-', '-', '>'},
                    {'C', '-', '-', '-', '-', '-', '=', '-', '-', '>'},
                    {'a', '-', '=', '-', '<', '-', '-', '<', '<', '-'},
                    {'b', '-', '<', '=', '<', '-', '-', '<', '<', '-'},
                    {'c', '-', '-', '-', '-', '-', '>', '-', '-', '>'},
                    {'d', '=', '<', '<', '<', '<', '-', '<', '<', '-'},
                    {'e', '-', '-', '-', '-', '-', '>', '-', '-', '>'}};
    static int matrixIndex = 0;
    static boolean find = false;
    static String chain;
    static int chainCounter = 0;      // Счетчик для цепочки
    static int relationIndex = 0;     // Индекс смежности

    public static void main(String[] args) {

        //Входная цепочка
        System.out.print("Input chain: ");
        Scanner in = new Scanner(System.in);
        chain = in.nextLine() + "#";
        System.out.println(chain);
        in.close();
        stack.push('#');
        firtsChar();
        do {
            if (chain.charAt(chainCounter) == '#') {
                findRules();
            }
            //find relation index
            for (int counter = 1; counter < matrix.length; counter++) {
                relationIndex = 0;
                if (chain.charAt(chainCounter) == matrix[0][counter]) {
                    relationIndex = counter;
                    break;
                }
            }
            if (relationIndex == 0) {
                System.out.println("Wrong terminal");
                System.exit(1);
            }
            //Try shift stack
            if ((matrix[matrixIndex][relationIndex] == '<') || (matrix[matrixIndex][relationIndex] == '=')) {
                stack.push(chain.charAt(chainCounter));
                matrixIndex = relationIndex;
                chainCounter++;
                System.out.println(stack);
            } else {
                if (matrix[matrixIndex][relationIndex] == '>') {
                    findRules();
                }
            }

        } while (chain.charAt(chainCounter) != chain.length());
        findRules();
        stack.push(chain.charAt(chainCounter));
        System.out.println(stack);
        if (stack.toString().endsWith("[#, A, #]")) {
            System.out.println("SUCCESS!");
        }

    }

    static void firtsChar() {
        int i = 5;
        boolean findFirst = false;
        while (i < matrix.length) {
            if (chain.charAt(chainCounter) == matrix[i][0]) {
                findFirst = true;
                stack.push(chain.charAt(chainCounter));
                matrixIndex = i;
                chainCounter++;
                break;
            }
            i++;
        }
        if (!findFirst) {
            System.out.println("Not terminal");
            System.exit(1);
        }

    }

    static void findRules() {
        find = false;
        boolean repeat = false;
        System.out.println(stack.toString());
        if (stack.toString().endsWith("[#, A]")) {
            stack.push('#');
            System.out.println(stack);
            System.out.println("SUCCESS!");
            System.exit(0);
        }

        if ((stack.toString().endsWith("c]")) || (stack.toString().endsWith("d, A, e]"))) {
            find = true;
            if (stack.toString().endsWith("d, A, e]")) {
                stack.pop();
                stack.pop();
                stack.pop();
            }
            if (stack.toString().endsWith("c]")) {
                stack.pop();
            }
            stack.push('C');
            matrixIndex = 4;
        }
        if ((stack.toString().endsWith("C]")) || (stack.toString().endsWith("C, b, B]"))) {
            find = true;
            if (stack.toString().endsWith("C, b, B]")) {
                stack.pop();
                stack.pop();
                stack.pop();
            }
            if (stack.toString().endsWith("C]")) {
                stack.pop();
            }
            stack.push('B');
            matrixIndex = 2;
        }
        if ((stack.toString().endsWith("a, B]")) || (stack.toString().endsWith("D]"))) {
            find = true;
            if (stack.toString().endsWith("a, B]")) {
                stack.pop();
                stack.pop();
            }
            if (stack.toString().endsWith("D]")) {
                stack.pop();
            }
            stack.push('A');
            matrixIndex = 1;
        }
        if (stack.toString().endsWith("B]")) {
            find = true;
            stack.pop();
            stack.push('D');
            matrixIndex = 3;
        }

        if (find) {
            findRules();
        }
        System.out.println(stack);

    }
}
