package loop;

public class ForDemo2 {
  public static void main(String[] args) {
    // 求水仙花數（各位數的立方和＝原數）
    int count = 0;
    for(int i = 100; i < 1000; i++) {
      int ge = i % 10;
      int shi = i / 10 % 10;
      int bai = i / 100;
      if(ge*ge*ge + shi*shi*shi + bai*bai*bai == i) {
        System.out.print(i + " ");
        count++;
      }
    }
    System.out.println();
    System.out.println("水仙花數共有" + count + "個");
  }
}
