package loop;
import java.util.Random;
import java.util.Scanner;

public class RandomDemo1 {
  public static void main(String[] args) {
    Random r = new Random(); // 生成0～n的隨機數

    for(int i = 0; i < 10; i++) {
      int data = r.nextInt(10) + 1;
      // r.nextInt(10)+1 -> (0～9)隨機數+1 -> (1～10)隨機數
      System.out.print(data + " ");
    }
    System.out.println();

    // 1～100猜數字
    int luckNumber = r.nextInt(100) + 1;
    Scanner sc = new Scanner(System.in);
    while(true) {
      System.out.println("請輸入您猜測的數字(1～100)：");
      int guessNumber = sc.nextInt();

      if(guessNumber > luckNumber) {
        System.out.println("您猜測的數字過大！");
      } else if(guessNumber < luckNumber) {
        System.out.println("您猜測的數字過小！");
      } else {
        System.out.println("恭喜您猜中了！");
        break; // 跳出無限循環
      }
    }
    sc.close();
  }
}
