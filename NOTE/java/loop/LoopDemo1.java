package loop;
import java.util.Scanner;

public class LoopDemo1 {
  public static void main(String[] args) {
    // 無限循環
    // for( ; ; ) {
    //   System.out.println("Hello World!");
    // }

    // while(true) {
    //   System.out.println("Hello World!");
    // }

    // do {
    //   System.out.println("Hello World!");
    // } while (true);

    int password = 520;
    Scanner sc = new Scanner(System.in);
    while(true) {
      System.out.println("請輸入正確的密碼：");
      int passwordInput = sc.nextInt();
      if(passwordInput == password) {
        System.out.println("登入成功！");
        break; // ループを抜ける
      } else {
        System.out.println("密碼錯誤！");
      }
    }
    sc.close();
  }
}
