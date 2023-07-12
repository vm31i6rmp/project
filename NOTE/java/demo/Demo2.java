package demo;

import java.util.Random;

public class Demo2 {
  public static void main(String[] args) {
    // 生成隨機字串
    System.out.println("隨機驗證碼：" + createCode(10));
  }
  public static String createCode(int n) {
    String code = "";
    Random r = new Random();
    for (int i = 0; i < n; i++) {
      int type = r.nextInt(3); // 0 1 2
      switch (type) {
        case 0:
          // 大寫字母 A(65) Z(65+25)
          char ch = (char)(r.nextInt(26) + 65);
          code += ch;
          break;
        case 1:
          // 小寫字母 a(97) z(97+25)
          char ch2 = (char)(r.nextInt(26) + 97);
          code += ch2;
          break;
        case 2:
          // 數字 0-9
          code += r.nextInt(10);
          break;
      }
    }
    return code;
  }
}
