package array;

public class ArrayDemo2 {
  public static void main(String[] args) {
    // 配列の元素ごとに伺う
    int[] arr = {10, 20, 30, 40 ,50};
    for(int i = 0; i < arr.length; i++) {
      System.out.print(arr[i] + " ");
    }

    // 合計
    int[] money = {10, 20, 30, 40, 50};
    int sum = 0;
    for (int i = 0; i < arr.length; i++) {
      sum += money[i];
    }
    System.out.println();
    System.out.println("sum = " + sum);

    // 最大値
    int[] nums = {15, 40, 30, 60, 10, 90, 70, 55};
    int max = nums[0];
    System.out.print(nums[0] + " ");
    for (int i = 1; i < nums.length; i++) {
      max = max > nums[i] ? max : nums[i];
      System.out.print(nums[i] + " ");
    }
    System.out.println();
    System.out.println("max = " + max);
  }
}
