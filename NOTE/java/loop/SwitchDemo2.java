package loop;

public class SwitchDemo2 {
  public static void main(String[] args) {
    // 注意事項
    //（1）byte、short、int、char、String（JDK7より）のみ（double、float、longは使用不可）
    //（2）値は重複してはいけない！変数は使用不可
    //（3）breakがないと抜け出せない
    int month = 7;
    switch (month) {
      case 1:
      case 3:
      case 5:
      case 7:
      case 8:
      case 10:
      case 12:
        System.out.println(month + "月に31日があります！");
        break;
      case 2:
        System.out.println(month + "月に28日か29日があります！");
        break;
      case 4:
      case 6:
      case 9:
      case 11:
        System.out.println(month + "月に30日があります！");
        break;
      default:
        System.out.println("エラー！");
        break;
    }
  }
}
