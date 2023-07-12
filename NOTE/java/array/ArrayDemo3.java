package array;

import java.util.Random;
import java.util.Scanner;

public class ArrayDemo3 {
  public static void main(String[] args) {
    // 猜數字。隨機生成1～20之間的五個數字（可重複）
    int[] data = new int[5];
    Random r = new Random();
    for (int i = 0; i < data.length; i++) {
      data[i] = r.nextInt(20) + 1;
    }

    Scanner sc = new Scanner(System.in);
    OUT:
    while(true) {
      System.out.println("請輸入1～20之間的整數：");
      int numInput = sc.nextInt();
      for (int i = 0; i < data.length; i++) {
        if(data[i] == numInput) {
          System.out.println("您猜中了！猜中的數字索引(index) = " + i);
          break OUT; // 不只當前的if循環、結束整個while的無限循環
        }
      }
      System.out.println("猜測的數字不存在於配列中、請重新猜測！");
    }
    sc.close();

    System.out.print("數字列為 ");
    for (int i = 0; i < data.length; i++) {
      System.out.print(data[i] + " ");
    }
  }
}
