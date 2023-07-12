package method;

public class MethodDemo2 {
  public static void main(String[] args) {
    System.out.println("1から100の合計値は " + sum(100));
    check(100);
    int[] ages = {23, 19, 25, 35, 28};
    System.out.println("max = " + getMax(ages));
  }

  // 1 + 2 + ... + n
  public static int sum(int n) {
    int sum = 0;
    for (int i = 0; i < n; i++) {
      sum += i;
    }
    return sum;
  }

  // 奇数と偶数の判断
  public static void check(int num) {
    if(num % 2 == 0) {
      System.out.println(num + " は偶数！");
    } else {
      System.out.println(num + " は奇数！");
    }
  }

  // 最大値
  public static int getMax(int[] arr) {
    int max = arr[0];
    for (int i = 1; i < arr.length; i++) {
      if(arr[i] > max) {
        max = arr[i];
      }
    }
    return max;
  }
}
