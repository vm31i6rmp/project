package operator_sample;

public class OperatorDemo4 {
  public static void main(String[] args) {
    // 關係運算子（== > < != >= <=）
    // 邏輯運算子（& | ! ^）
    System.out.println(true ^ false);  // 不同解果為true
    System.out.println(false ^ true);  // 不同解果為true
    System.out.println(true ^ true);   // 相同解果為false
    System.out.println(false ^ false); // 相同解果為false

    // 短路邏輯運算子
    System.out.println("--------- && 和 || 的區別 ---------");
    int a = 10;
    int b = 20;
    System.out.println(a > 100 && ++b > 10); // 左邊為false時、右邊不執行
    System.out.println(b);
    System.out.println(a > 100 & ++b > 10); // 左邊為false時、右邊仍執行
    System.out.println(b);

    int i = 10;
    int j = 20;
    System.out.println(i > 1 || ++j > 10); // 左邊為true時、右邊不執行
    System.out.println(j);
    System.out.println(i > 1 | ++j > 10); // 左邊為true時、右邊仍執行
    System.out.println(j);
  }
}
