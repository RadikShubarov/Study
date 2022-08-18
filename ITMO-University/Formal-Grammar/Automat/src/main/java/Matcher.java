public class Matcher {
    private char[] s;
    private int curInd = 0;

    public Matcher(String s) {
        this.s = s.toCharArray();
    }

    public boolean isMatches() {
        try {
            check('b');
            check('a');
            while (curIsEquals('a')) {
                next();
                switch (cur()) {
                    case 'b':
                    case 'c':
                        next();
                        break;
                    default:
                        throw new IllegalStateException("Expected a or b" + ", but actual " + cur() + " at index " + curInd);
                }
            }
            check('c');
            check('b');
            checkIsEnd();
            return true;
        } catch (IllegalStateException e) {
            System.out.println(e.getMessage());
            return false;
        }
    }

    private char cur() {
        return s[curInd];
    }

    private void next() {
        curInd++;
    }

    private void check(char c) {
        checkNotEnd();
        if (!curIsEquals(c)) {
            throw new IllegalStateException("Expected " + c + ", but actual " + cur() + " at index " + curInd);
        }
        next();
    }

    private boolean curIsEquals(char c) {
        return cur() == c;
    }

    private void checkNotEnd() {
        if (isEnd()) {
            throw new IllegalStateException("Expected char, but actual end of string");
        }
    }

    private void checkIsEnd() {
        if (!isEnd()) {
            throw new IllegalStateException("Expected end of string");
        }
    }

    private boolean isEnd() {
        return s.length == curInd;
    }
}
