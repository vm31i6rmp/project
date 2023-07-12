package operator_sample;

public class OperatorDemo1 {
  // 数値変換
  public static void main(String[] args) {
    byte a = 1;
    short b = 2;
    int c = 3;
    double d = 4.0; // default
    float e1 = 5;
    float e2 = 5.0F;

    System.out.println(a);
    System.out.println(b);
    System.out.println(c);
    System.out.println(d);
    System.out.println(e1);
    System.out.println(e2);

    // 小範圍的變數可以轉換成大範圍的變數
    char ch = 'a';
    int f = ch;
    System.out.println(f);

    // 小範圍的變數會自動轉換成大範圍的變數進行運算
    // byte、short、char -> int -> long -> float -> double
    double res = c + d;
    System.out.println(res);

    // 強制轉換（大範圍變數格納給小範圍變數）
    int i = 20;
    byte j = (byte)i;
    System.out.println(j);

    int n = 1500;            // (int＝4字節＝32位) 00000000 00000000 00000101 11011100
    byte m = (byte)n;        // (byte＝1字節＝8位) -------- -------- -------- 11011100
    System.out.println(m);   // 只有末8位可以格納

    // 浮點強制轉換整數時會捨棄小數部分
  }
}
