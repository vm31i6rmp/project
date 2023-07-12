package array;

import java.util.Random;
import java.util.Scanner;

public class ArrayDemo4 {
  public static void main(String[] args) {
    // 隨機排序
    int[] ids = new int[5];
    Scanner sc = new Scanner(System.in);
    for (int i = 0; i < ids.length; i++) {
      System.out.println("請輸入第" + (i + 1) + "個員工ID：");
      int id = sc.nextInt();
      ids[i] = id;
    }
    sc.close();

    Random r = new Random();
    for (int i = 0; i < ids.length; i++) {
      int newIndex = r.nextInt(ids.length);
      // 定義一個臨時變數格納欲交換的值
      int temp = ids[newIndex];
      ids[newIndex] = ids[i];
      ids[i] = temp;
    }

    System.out.println("生成的排序：");
    for (int i = 0; i < ids.length; i++) {
      System.out.print(ids[i] + " ");
    }
  }
}
