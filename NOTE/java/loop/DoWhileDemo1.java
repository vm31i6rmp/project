package loop;

public class DoWhileDemo1 {
  public static void main(String[] args) {
    // 先執行一次再判斷循環條件（首次不判斷循環條件＝必定執行）
    int i = 0;
    do {
      System.out.println("Hello World!");
      i++;
    } while (i < 3); // 最終 i = 3
  }
}
