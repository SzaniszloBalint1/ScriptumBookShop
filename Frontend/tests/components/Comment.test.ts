// tests/components/Books/Comment.test.ts
import { mount } from "@vue/test-utils";
import Comment from "@/components/Books/Comment.vue";
import { describe, it, expect, vi, beforeEach } from "vitest";

describe("Comment.vue", () => {
  const mockComments = [
    {
      id: 1,
      book_id: 1,
      user_id: 1,
      comment: "This is a test comment",
      created_at: "2022-01-01T12:00:00.000Z",
      user: {
        id: 1,
        Username: "TestUser"
      }
    }
  ];
  
  const mockUser = {
    id: 1,
    Username: "TestUser"
  };
  
  let mockStore;
  
  beforeEach(() => {
    mockStore = {
      getters: {
        "comment/comments": mockComments,
        "comment/hascomments": true,
        "user/user": mockUser
      },
      dispatch: vi.fn().mockResolvedValue(true)
    };
    
    vi.clearAllMocks();
  });
  
  
  it("handles comment submission without login", async () => {
    const noUserStore = {
      getters: {
        "comment/comments": mockComments,
        "comment/hascomments": true,
        "user/user": null
      },
      dispatch: vi.fn().mockResolvedValue(true)
    };
    
    const wrapper = mount(Comment, {
      props: {
        bookId: 1
      },
      global: {
        mocks: {
          $store: noUserStore
        }
      }
    });
    
    noUserStore.dispatch.mockClear();
    
    await wrapper.find("textarea").setValue("New test comment");
    await wrapper.find("form").trigger("submit.prevent");
    
    expect(noUserStore.dispatch).not.toHaveBeenCalledWith("comment/addComment", expect.anything());
    
    expect(wrapper.find(".alert-danger").exists()).toBe(true);
    expect(wrapper.find(".alert-danger").text()).toContain("Hozzászóláshoz be kell jelentkezned");
  });
});