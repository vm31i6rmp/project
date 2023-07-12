package method;

public class MethodDemo1 {
  public static void main(String[] args) {
    int c1 = sum(10, 30);
    System.out.println(c1);
    print();
  }
  public static int sum(int a, int b) { // メソッドを定義（値を返すには return）
    int c = a + b;
    return c;
  }
  public static void print() { // 型の定義が要らないメソッド（返す値が不要な場合は void）
    System.out.println("Hello World!");
  }
}
