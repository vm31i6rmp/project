package loop;

public class SwitchDemo1 {
  public static void main(String[] args) {
    // switch分岐
    String weekday = "水曜";
    switch (weekday) {
      case "月曜":
        System.out.println("今日は月曜日です！");
        break;
      case "火曜":
        System.out.println("今日は火曜日です！");
        break;
      case "水曜":
        System.out.println("今日は水曜日です！");
        break;
      case "木曜":
        System.out.println("今日は木曜日です！");
        break;
      case "金曜":
        System.out.println("今日は金曜日です！");
        break;
      case "土曜":
        System.out.println("今日は土曜日です！");
        break;
      case "日曜":
        System.out.println("今日は日曜日です！");
        break;
      default:
        System.out.println("曜日が間違っています！");
    }
  }
}
