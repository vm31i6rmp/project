package method;

public class MethodDemo8 {
  // 方法重載＝method名稱相同、但參數型態不同的話OK！
  public static void main(String[] args) {
    fire();
    fire("Ｂ國");
    fire("Ｃ國", 2);
  }
  public static void fire() {
    // System.out.println("發射1枚武器給Ａ國");
    fire("Ａ國");
  }
  public static void fire(String location) {
    // System.out.println("發射1枚武器給" + location);
    fire(location, 1);
  }
  public static void fire(String location, int num) {
    System.out.println("發射" + num + "枚武器給" + location);
  }

  public static void open() {}
  public static void open(int a) {}
  public static void open(int a, int b) {}
  public static void open(double a, int b) {}
  public static void open(int a, double b) {} // 參數型態不同（順序不同）-> 不重複
  // public static void open(int i, double d) {} // 參數型態相同 -> 重複
  public static void OPEN() {} // method名不同 -> 不重複（大小寫有區分）

  // return 單獨使用 -> 跳出當前method、並結束method執行
}
