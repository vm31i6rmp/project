package loop;

public class LoopDemo2 {
  public static void main(String[] args) {
    // break; 跳脫並結束當前所在循環或switch分支
    // continue; 立刻跳出循環中的當次執行、進入下一次執行

    for(int i = 1; i <= 5; i++) {
      if(i == 3) {
        continue;
      }
      System.out.println(i);
    }
  }
}
