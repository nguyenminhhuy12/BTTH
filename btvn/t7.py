import streamlit as st
import pandas as pd
import matplotlib.pyplot as plt

# Hàm tính toán SJF (đúng chuẩn với hàng đợi sẵn sàng)
def calculate_sjf(processes):
    # Sắp xếp ban đầu theo thời điểm đến
    processes = sorted(processes, key=lambda x: x[1])
    time = 0  # Thời gian hiện tại
    schedule = []  # Lịch trình thực thi (pid, start_time, finish_time)
    results = []  # Kết quả chi tiết từng tiến trình
    ready_queue = []  # Hàng đợi tiến trình sẵn sàng
    
    while processes or ready_queue:
        # Thêm các tiến trình đã đến vào hàng đợi
        while processes and processes[0][1] <= time:
            ready_queue.append(processes.pop(0))
        
        # Sắp xếp hàng đợi theo burst_time
        ready_queue.sort(key=lambda x: x[2])
        
        if ready_queue:
            # Chọn tiến trình có burst_time nhỏ nhất
            pid, arrival, burst = ready_queue.pop(0)
            start_time = max(time, arrival)
            finish_time = start_time + burst
            turnaround = finish_time - arrival
            waiting = turnaround - burst
            results.append((pid, arrival, burst, start_time, finish_time, turnaround, waiting))
            schedule.append((pid, start_time, finish_time))
            time = finish_time  # Cập nhật thời gian
        else:
            # Nếu không có tiến trình nào sẵn sàng, nhảy tới thời điểm đến tiếp theo
            time = processes[0][1] if processes else time
    
    return results, schedule

# Hàm vẽ biểu đồ Gantt
def draw_gantt_chart(schedule):
    fig, ax = plt.subplots(figsize=(10, 4))
    for process_id, start, finish in schedule:
        ax.barh(0, finish - start, left=start, align='center', edgecolor='black', color='skyblue')
        ax.text((start + finish) / 2, 0, f"P{process_id}", ha='center', va='center', color='black', fontsize=10)
    ax.set_yticks([])
    ax.set_xlabel("Thời gian (ms)")
    ax.set_title("Biểu đồ Gantt - Thuật toán SJF")
    st.pyplot(fig)

# Giao diện Streamlit
st.title("Demo thuật toán SJF (Shortest Job First)")

# Hiển thị thông tin ở Sidebar
st.sidebar.header("Nhập thông tin tiến trình")
num_processes = st.sidebar.number_input("Số lượng tiến trình", min_value=1, max_value=20, value=3, step=1)

process_data = []
if num_processes > 0:
    for i in range(num_processes):
        arrival = st.sidebar.number_input(
            f"Thời điểm đến của P{i+1} (ms)", min_value=0, value=0, step=1, key=f"arrival_{i}")
        burst = st.sidebar.number_input(
            f"Thời gian sử dụng CPU của P{i+1} (ms)", min_value=1, value=1, step=1, key=f"burst_{i}")
        process_data.append((i + 1, arrival, burst))

# Nút tính toán
if st.sidebar.button("Tính toán"):
    if len(process_data) > 0:
        # Gọi hàm tính toán SJF
        results, schedule = calculate_sjf(process_data)

        # Chuyển đổi kết quả thành DataFrame
        df = pd.DataFrame(results, columns=[
            "Tiến trình", "Thời điểm đến (ms)", "Thời gian sử dụng CPU (ms)",
            "Thời gian bắt đầu (ms)", "Thời gian kết thúc (ms)",
            "Thời gian lưu lại (ms)", "Thời gian chờ (ms)"
        ])

        # Hiển thị bảng kết quả
        st.subheader("Kết quả:")
        st.dataframe(df)

        # Hiển thị biểu đồ Gantt
        st.subheader("Biểu đồ Gantt:")
        draw_gantt_chart(schedule)
    else:
        st.warning("Chưa có tiến trình nào được nhập. Vui lòng nhập thông tin tiến trình.")
else:
    st.info("Vui lòng nhập thông tin tiến trình ở thanh bên trái và bấm 'Tính toán' để xem kết quả.")
