package method;

public class MethodDemo3 {
  // 基本類型的參數傳遞機制
  public static void main(String[] args) {
    int a = 10;
    change(a); // 值傳遞＝傳遞給change()的為a的值10而非a參數本身＝change(10)
    System.out.println(a); // 10
  }
  public static void change(int a) {
    System.out.println(a); // 10
    a = 20;
    System.out.println(a); // 20
  }
}
