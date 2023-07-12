package demo;

public class Demo1 {
  public static void main(String[] args) {
    // 素数を探す
    for (int i = 100; i < 999; i++) {
      boolean flag = true;
      for (int j = 2; j < i / 2; j++) {
        if (i % j == 0) {
          flag = false;
          break;
        }
      }
      if(flag) {
        System.out.print(i + " ");
      }
    }
  }
}
