package method;

public class MethodDemo4 {
  // 引用類型的參數傳遞機制
  public static void main(String[] args) {
    int[] arr = {10, 20, 30};
    change(arr); // 值傳遞＝傳遞給change()的為arr的地址
    System.out.println(arr[1]); // 222
  }
  public static void change(int[] arr) {
    System.out.println(arr[1]); // 20
    arr[1] = 222;
    System.out.println(arr[1]); // 222
  }
}
